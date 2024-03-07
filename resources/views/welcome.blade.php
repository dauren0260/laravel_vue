@extends("layouts.index")
@section("content")
<div id="app">

    {{-- 搜尋留言 --}}
    <div class="searchArea py-3" method="get">
        <div>搜尋留言</div>
        作者：<input type="text" name="author" id="author" class="searchInput" value="">
        留言：<input type="text" name="content" id="content" class="searchInput" value="">
        <div class="py-3">
            <span>起始日期：<input type="date" name="startDate" value="" id="startDate"></span><br/>
            <span>結束日期：<input type="date" name="endDate"  value="" id="endDate"></span>
        </div>
        <button type="button" @click="searchMsg()" class="btn btn-outline-secondary">搜索</button>
    </div>

    {{-- 訊息 --}}
    <div v-if="errorMsg.msg != ''" class="col-md-4 offset-md-4">
        <div class="alert alert-info text-center" role="alert">
            <strong>@{{errorMsg.msg}}</strong>
        </div>
    </div>
    {{-- 留言列表 --}}
    <div v-if="data.searchResult">
        <div v-for="item of data.messages" :key="item.commentNo" class="container-sm d-flex justify-content-md-around mt-5 mb-3 pb-3 align-items-center border-bottom border-secondary-subtle" >
            <div class="me-auto">
                <div class="avatar">
                    <img :src="'img/avatar/'+item.memAvatar" alt="avatar">
                </div>
                <div class="memContent">
                    <div class="memberName">@{{item.memName}}</div>
                    <div class="commentTime">@{{item.updated_at}}</div>
                </div>
                <div class="msgContent showContent">
                    <pre>@{{item.comment}}</pre>
                </div>
            </div>
            <div class="actionArea">
                <div class="edit mb-3">
                    <a :href="'/message/'+item.commentNo+'/edit'" class="btn btn-outline-primary" role="button">編輯</a>
                </div>
                <div class="delete">
                    <input type="hidden" name="delMsg" :value="item.commentNo" />
                    <button type="button" @click="deleteMsg(item.commentNo)" class="btn btn-outline-danger delBtn">刪除</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-sm" v-else>
            Ooops..沒有符合的筆數
    </div>

    {{-- 新增留言 --}}
    <div class="msgContainer">
        <div class="flex-shrink-1 avatar commentAvatar">
            <img src="./img/avatar/avatar1.png" alt="avatar">
            <div class="username">哆啦美</div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" name="comment" id="floatingTextarea" required></textarea>
            <label for="floatingTextarea">留言</label>
            <button type="submit" @click="insertMsg" value="send" class="btn btn-outline-primary">送出</button>
        </div>
    </div>
</div>

<script>
    const {
        createApp
        , onMounted
        , reactive
    } = Vue

    createApp({
        setup() {
            let data = reactive({
                messages:[],
                searchResult:false
            })
            let errorMsg = reactive({msg:''})

            onMounted(() => {
                axios.get('http://localhost/api/message')
                .then((res) => {
                    if(res.data.length != 0){
                        data.messages = res.data;
                        data.searchResult = true;
                    }
                })
                return {data}
            })

            let insertMsg = () => {
                axios.post('http://localhost/api/message', {
                    comment: floatingTextarea.value,
                })
                .then( response => {
                    location.reload();
                    errorMsg.msg = response.data.message;
                })
                .catch(function (error) {
                    errorMsg.msg = "新增失敗"
                    console.log(error);
                })
            }

            let searchMsg = () => {

                axios.get('http://localhost/api/message',{
                    params:{
                        author : author.value,
                        content : content.value,
                        startDate: startDate.value,
                        endDate: endDate.value
                    }
                })
                .then((res) => {
                    if(res.data.length == 0){
                        data.searchResult = false;
                    }else{
                        data.searchResult = true;
                        data.messages = res.data;
                    }
                }).catch(function (error) {
                    console.log(error);
                })
                return {data}
            }

            let deleteMsg = (commentNo) => {
                console.log("deleteMsg fun",commentNo)

                axios.delete(`http://localhost/api/message/${commentNo}`)
                .then( response => {
                    console.log(response);
                    location.reload();
                    errorMsg.msg = response.data.message;
                })
                .catch(function (error) {
                    console.log(error);
                    errorMsg.msg = "刪除失敗"
                })
            }

            return {data,errorMsg,deleteMsg,insertMsg,searchMsg}
        }
    }).mount('#app');

</script>
@endsection
