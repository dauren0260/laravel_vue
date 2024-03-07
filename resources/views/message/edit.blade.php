@extends("layouts/index")
@section("content")
<div id="app">
 
    <div class="title">留言版 - 編輯留言</div>    

    <div class="container-sm" >
        <div class="msgContainer">
            <div class="avatar commentAvatar">
                <img :src="'http://localhost/img/avatar/'+data.messages.memAvatar" alt="avatar">
                <div class="username">@{{data.messages.memName}}</div>
            </div>
            <textarea name="comment" id="content" cols="80" rows="15">@{{data.messages.comment}}</textarea>
        </div>
        <div class="btnArea">
            <a href="{{ URL::previous() }}" class="btn btn-outline-primary" role="button">取消</a>
            <input type="hidden" name="delMsg" :value="data.messages.commentNo" />
            <button type="button" @click="deleteMsg(data.messages.commentNo)" class="btn btn-outline-danger delBtn">刪除</button>
        </div>
    </div>
</div>
<style>
    .msgContainer, .btnArea{
        text-align: center;
    }

    textarea{
        width: 40vw;
        height: 30vh;
    }

    button{
        margin-left: 10px;
    }
</style>
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

            onMounted(() => {
                console.log(location.href)
                axios.get('http://localhost/api/message/36')
                .then((res) => {
                    console.log(res.data)
                    data.messages = res.data;
                })
                return {data}
            })

            return {data}
        }
    }).mount('#app');

</script>
    
@endsection