
    @extends("layouts.index")
    @section("content")

    @if (\Session::has("status"))
    <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
            <strong class="me-auto">訊息通知</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {!! \Session::get("status") !!}
            </div>
        </div>
    </div>
    @endif
    <form action="/message" class="searchArea py-3" method="get">
        <div>搜尋留言</div>
        作者：<input type="text" name="author" class="searchInput" value="{{$gets['author']??''}}">
        留言：<input type="text" name="content" id="content" class="searchInput" value="{{$gets['content']??''}}">
        <div class="py-3">
            <span>起始日期：<input type="date" name="startDate" value="{{$gets['startDate']??''}}"></span><br/>
            <span>結束日期：<input type="date" name="endDate"  value="{{$gets['endDate']??''}}" id="endDate"></span>
        </div>
        <button class="btn btn-outline-secondary">搜索</button>
    </form>

   
    @forelse($lists as $list)
    <div class="container-sm d-flex justify-content-md-around mb-3 pb-3 align-items-center border-bottom border-secondary-subtle">
        <div class="me-auto">
            <div class="avatar">
                <img src="{{asset('img/avatar/'.$list->memAvatar)}}" alt="avatar">
            </div>
            <div class="memContent">
                <div class="memberName">{{$list->memName}}</div>
                <div class="commentTime">{{$list->updated_at}}</div>
            </div>
            <div class="msgContent showContent">
                {!! nl2br(e($list->comment)) !!}
            </div>
        </div>
        <div class="actionArea">
            <div class="edit mb-3">
                <a href="/message/{{$list->commentNo}}/edit"
                    class="btn btn-outline-primary" role="button">編輯</a>
            </div>
            <form action="/message/{{$list->commentNo}}" method="post" class="delete">
                @csrf
                @method("delete")
                <button type="submit" class="btn btn-outline-danger delBtn">刪除</button>
            </form>
        </div>
    </div>
    @empty
    <div class="container-sm">
            Ooops..沒有符合的筆數
    </div>
    @endforelse

    <form action="/message" method="post" class="insert">
        @csrf
        <div class="msgContainer">
            <div class="flex-shrink-1 avatar commentAvatar">
                <img src="./img/avatar/avatar1.png" alt="avatar">
                <div class="username">哆啦美</div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" name="comment" id="floatingTextarea" required></textarea>
                <label for="floatingTextarea">留言</label>
                <button type="submit" value="send" class="btn btn-outline-primary">送出</button>
            </div>
        </div>
    </form>
@endsection