<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登陆界面</title>
</head>
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

<style>
    body{
        background: url("http://pic1.win4000.com/wallpaper/a/589d21f451e0b.jpg");
    }
    .login-form {
        position: absolute;
        background: #00CCFF;
        padding: 20px;
        top: 25%;
        -moz-transformY: -50%;
        -webkit-transformY; -50%;
        -o-transformY; -50%;
        -ms-transformY; -50%;
        transformY; -50%;

        -moz-border-radius: 10px;
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 login-form">
            <form action="{:url('index/login')}" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">邮&nbsp;&nbsp;&nbsp;&nbsp;箱：</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <button type="submit" class="btn btn-default">登陆</button>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-default" onclick="location.href='{:url(\'index/to_register\')}'">注册</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
