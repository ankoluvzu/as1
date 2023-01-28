
<form action="" method="POST" enctype="multipart/form-data">
	<input type="hidden" name = "user[id]" value = " <?=$user['id']??''?>">

				<label>Username</label>
				<input type="text" name="login[name]"  value = " <?=$user['username']??''?>">

				<label>Password</label>
                <input type="text" name="user[password]"  value = " <?=$user['password']??''?>">

                <label>Status</label>
				<input type="text" name="user[status]"  value = " <?=$user['status']??''?>">

                <input type="submit" name="submit"  value="Create"/>

			</form>

