@extends("layouts.index")
@section("content")
<style>
    /* ul */
    .nav-tabs {
        margin-top: 50px;
        justify-content: space-around;
        border-bottom: none;
        position: relative;
    }

    /* li */

    .nav-item::before {
        content: "";
        display: block;
        width: 25%;
        height: 2px;
        background-color: var(--beforeColor);
        position: absolute;
        top: 0px;
    }

    .nav-item {
        line-height: 60px;
        border: 1px solid #dfdfdf;
        border-right: 1px dashed #dfdfdf;
        box-sizing: border-box;
        --beforeColor: "#dfdfdf";
    }

    .nav-item:not(:first-child) {
        border-left: none;
    }

    .nav-item:last-child {
        border-right-style: solid;
    }


    /* button */
    .nav-item .nav-link {
        border: none;
        color: #4d4f52;
        padding: 0;
        width: 100%;
    }

    .nav-tabs .nav-link.active {
        color: #0a58ca;
        background-color: unset;
    }

    .nav-tabs .nav-link.active:hover {
        background-color: unset;
    }

    .nav-item .nav-link:focus,
    .nav-item .nav-link:hover {
        background-color: unset;
        border: none;
    }

    hr {
        margin: 50px;
    }

</style>
<style>
    .steps {
        border: 1px solid #e7e7e7
    }

    .steps-header {
        padding: .375rem;
        border-bottom: 1px solid #e7e7e7
    }

    .steps-header .progress {
        height: .25rem
    }

    .steps-body {
        display: table;
        table-layout: fixed;
        width: 100%
    }

    .step {
        display: table-cell;
        position: relative;
        padding: 1rem .75rem;
        -webkit-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
        border-right: 1px dashed #dfdfdf;
        color: rgba(0, 0, 0, 0.65);
        text-align: center;
        text-decoration: none
    }

    .step:last-child {
        border-right: 0
    }

    .step-indicator {
        display: none;
        position: absolute;
        left: .75rem;
        width: 1.5rem;
        height: 1.5rem;
        border: 1px solid #e7e7e7;
        border-radius: 50%;
        background-color: #fff;
        font-size: .875rem;
        line-height: 1.375rem
    }

    .step-indicator.show{
        display: block;
    }

    .step:hover {
        color: rgba(0, 0, 0, 0.9);
        text-decoration: none;
        cursor:pointer;
    }

    .step.active,
    .step.active:hover {
        color: rgba(0, 0, 0, 0.9);
        pointer-events: none;
        /*cursor: default;*/
        font-weight: 600;
    }

    @media (max-width: 575.98px) {
        .steps-header {
            display: none
        }

        .steps-body,
        .step {
            display: block
        }

        .step {
            border-right: 0;
            border-bottom: 1px dashed #e7e7e7
        }

        .step:last-child {
            border-bottom: 0
        }
    }
</style>
<div>

    <!-- Progress-->
    <div class="steps">
        <div class="steps-header">
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <ul class="steps-body">
            <li class="step active" aria-controls="createActivity" id="createActivity-tab">新增招生活動</li>
            <li class="step" aria-controls="time" id="time-tab">時程</li>
            <li class="step" aria-controls="paperDocument" id="paperDocument-tab">文件</li>
            <li class="step" aria-controls="upload" id="upload-tab">上傳</li>
            <li class="step" aria-controls="profile" id="profile-tab">profile</li>
            <li class="step" aria-controls="contact" id="contact-tab">contact</li>
            <li class="step" aria-controls="class" id="class-tab">Class</li>
        </ul>
    </div>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="createActivity" role="tabpanel" aria-labelledby="createActivity-tab">新增招生活動</div>
        <div class="tab-pane" id="time" role="tabpanel" aria-labelledby="time-tab">時程</div>
        <div class="tab-pane" id="paperDocument" role="tabpanel" aria-labelledby="paperDocument-tab">文件</div>
        <div class="tab-pane" id="upload" role="tabpanel" aria-labelledby="upload-tab">上傳</div>
        <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">Profile</div>
        <div class="tab-pane" id="contact" role="tabpanel" aria-labelledby="contact-tab">Contact</div>
        <div class="tab-pane" id="class" role="tabpanel" aria-labelledby="class-tab">Class</div>
    </div>

    <div class="mt-5 px-3 d-flex justify-content-between">
        <button class="btn btn-primary disabled" id="prev">返回</button>
        <button class="btn btn-primary" id="next">繼續</button>
    </div>
</div>

<script>
    $(".steps-body>li:not(:first-child)").css("background-color","red");
    //$(".steps-body>li:not(:first-child)").css("cursor","default");

    let tabNum = $(".step").length;

    // 頁籤切換 
    $(".step").on("click", function() {
        $(".step").removeClass("active");
        $(".tab-pane").removeClass("show active");
        $(this).addClass("active");
        $(`#${$(this).attr("aria-controls")}`).addClass("show active");

        // 顯示進度條
        let percent = ($(this).index()+1)/tabNum;
        $(".progress-bar").css("width",`${percent*100}%`);

    })

    // 下一步按鈕切換
    $("#next").on("click", function() {
        // 找出下一個是誰
        let nextDiv = $(".step.active").next("li");
        let next = nextDiv.attr("aria-controls");
        let nextIndex = nextDiv.index();

        $(".step").removeClass("active");
        $(".tab-pane").removeClass("show active");
        $(`#${next}-tab`).addClass("active");   // 導覽列按鈕
        $(`#${next}`).addClass("show active");  // 內容區塊

        // 若後面沒有頁籤了，就讓按鈕disabled
        if (nextIndex == $(".step").last().index()) {
            $(this).addClass("disabled");
        } else {
            $("#prev").removeClass("disabled");
        }

        //顯示進度條
        let percent = (nextIndex+1)/tabNum;
        $(".progress-bar").css("width",`${percent*100}%`);
    })

    // 上一步按鈕切換
    $("#prev").on("click", function() {

        let prevDiv = $(".step.active").prev("li");
        let prev = prevDiv.attr("aria-controls");
        let prevIndex = prevDiv.index();

        $(".step").removeClass("active");
        $(".tab-pane").removeClass("show active");
        $(`#${prev}-tab`).addClass("active");   // 導覽列按鈕
        $(`#${prev}`).addClass("show active");  // 內容區塊

        // 若前面沒有頁籤了，就讓按鈕disabled
        if (prevIndex == $(".step").first().index()) {
            $(this).addClass("disabled");
        } else {
            $("#next").removeClass("disabled");
        }

        //顯示進度條
        let percent = (prevIndex+1)/tabNum;
        $(".progress-bar").css("width",`${percent*100}%`);
    })

    //初始進度條
    let initPercent =  $(".step.active").index()+1/tabNum;
    $(".progress-bar").css("width",`${initPercent*100}%`);

    //完成icon
    if($(".step").hasClass("step-completed")){
        $(this).find("span").addClass("show");
    }

</script>





@endsection
