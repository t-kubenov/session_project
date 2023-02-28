<h1>User Login</h1>
<form action="user" method="POST">
    @csrf
    <input type="text" name="user" placeholder="Enter Username:" id=""><br><br>
    <input type="password" name="password" placeholder="Enter Password:" id=""><br><br>
    <button type="submit">Login</button>
</form>
