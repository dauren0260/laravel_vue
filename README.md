routes/web.php
routes/api.php


用vue寫的留言板首頁
resources/views/welcome.blade.php

留言板編輯頁面
resources/views/message/edit.blade.php

引用的資源寫在
resources/views/layouts/index.blade.php


Controllers - 只return view
App/Http/Controllers/MessageController.php

Controllers - 只return api
App/Http/Controllers/Api/MessageApiController.php

Model
App/Models/Message.php