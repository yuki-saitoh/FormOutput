<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf8">
  <title>ログイン</title>
</head>
<body>
  <h1>ログイン</h1>
  <form action="/auth/login" method="post" name="loginForm">
    <table summary="ログインフォーム">
      <thead></thead><tfoot></tfoot>
      <tbody>
        <tr>
          <th>ログインID</th>
          <td>
            <input type="text" name="loginid">
          </td>
        </tr>
        <tr>
          <th>パスワード</th>
          <td>
            <input type="password" name="password">
          </td>
        </tr>
      </tbody>
    </table>
    <input type="submit" value="ログイン">
  </form>
</body>
</html>