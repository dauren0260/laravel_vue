<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/4.3.0/vue-router.global.js" integrity="sha512-N4taDSvDyV8rx+7cm9zUIm4bTWWLgjsytQpdlneu4kdrFGG9SRFnn8T0zwuZkzkhfvXRWWeNYX024hxqhVpk4Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vuex/4.1.0/vuex.global.js" integrity="sha512-QpO3y+QCyhGGkOJpIvJiadzSba8jCWBlmUOEhcHMoIukpItNeW/kKMeCwFMaSixp156ZTMdywPGuF5o27NjnKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.6.7/axios.min.js" integrity="sha512-NQfB/bDaB8kaSXF8E77JjhHG5PM6XVRxvHzkZiwl3ddWCEPBa23T76MuWSwAJdMGJnmQqM0VeY9kFszsrBEFrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>@yield("title","留言版")</title>
    <style>
        .avatar img{
            width: 50px;
        }

        .searchArea, .msgContainer, .editArea, .title{
            width: 500px;
            margin: 20px auto;
        }

        .avatar , .memContent{
            display: inline-block;
            vertical-align: middle;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div>
        @yield("content")
    </div>

</body>
</html>