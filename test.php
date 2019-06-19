<?php
require_once('./init.php');

\Couch\Couch::config(array(
    'host'               => 'https://couchdb.xxx.com', // dev OR live
    'Authorization'                => 'Basic ssssss==',
    'curlopt_ssl_verifypeer'    => false // default is false
));

// 查询用户是否存在
// $res = Couch\Core\User::find('bb23');
// var_dump('res',$res);

// // 创建用户
// $res2 = Couch\Core\User::create(['name'=>'bb','password'=>'apple','roles'=>[],'type'=>'user']);
// var_dump('res2',$res2);

// // 查询数据库是否存在
// $res3 = Couch\Core\DB::find('test333');
// var_dump('res3',$res3);

// 创建数据库
// $res4 = Couch\Core\DB::create(['dbId'=>'test333']);
// var_dump('res4',$res4);

// 查询数据库是否受保护
// $res5 = Couch\Core\DB::isProtected(['dbId'=>'test','userId'=>'admin1']);
// var_dump('res5',$res5);

// // // 保护数据库
// $params = [
//     "dbId"=>'test',
//     "security"=>[
//         "admins"=>[
//             "names"=>[
//                 "admin",
//                 "admin1",
//                 "bbb"
//             ]
//             ],
//             "members"=>[
//                 "names"=>[
//                     "admin",
//                     "admin1",
//                     "bbb"
//                 ]
//             ]
//     ]
// ];
// $res6 = Couch\Core\DB::setSecurity($params);
// var_dump('res6',$res6);