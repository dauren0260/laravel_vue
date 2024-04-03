#使用CDN連結Vue3

routes/web.php <br/>
routes/api.php


用vue寫的留言板首頁<br/>
resources/views/welcome.blade.php

留言板編輯頁面<br/>
resources/views/message/edit.blade.php

引用的資源寫在<br/>
resources/views/layouts/index.blade.php


Controllers - 只return view <br/>
App/Http/Controllers/MessageController.php

Controllers - 只return api<br/>
App/Http/Controllers/Api/MessageApiController.php

Model<br/>
App/Models/Message.php