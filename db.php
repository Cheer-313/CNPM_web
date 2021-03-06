<?php 
	// Import PHPMailer classes into the global namespace
	// These must be at the top of your script, not inside a function
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	// Load Composer's autoloader
	require 'vendor/autoload.php';

	define('HOST', '127.0.0.1');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'web');

	function open_db(){
		$conn = new mysqli(HOST, USER, PASS, DB);
		if($conn->connect_error){
			die('Connect error: '.$conn->connect_error);
		}
		return $conn;
	}

	//Đăng nhập, đăng kí
	function login($username, $password){
		$sql = "select * from user where username = ?";
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s', $username);

		if(!$stm->execute()){
			return null;
		}

		$result =  $stm->get_result();
		if ($result->num_rows == 0) {
			return null;
		}
		$data = $result->fetch_assoc();

		$hashed_password = $data['password'];
		if(!password_verify("$password", "$hashed_password")){
			return null;
		}
		else return $data;
	}

	function is_email_exists($email){
		$sql = 'select username from user where email = ?';
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$email);

		if(!$stm->execute()){
			die ('Error: '.$stm->error);
		}

		$result = $stm->get_result();
		if($result->num_rows > 0){
			return true;
		}
		else return false;
	}

	function is_username_exists($username){
		$sql = 'select username from user where username = ?';
		$conn = open_db();

		$stm = $conn->prepare($sql);
		$stm->bind_param('s',$username);

		if(!$stm->execute()){
			die ('Error: '.$stm->error);
		}

		$result = $stm->get_result();
		if($result->num_rows > 0){
			return true;
		}
		else return false;
	}

	function signUp($username, $password, $fullname, $dateofbirth, $email, $phone){
		if(is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email exists');
		}

		if(is_username_exists($username)){
			return array('code' => 3, 'error' => 'Username exists');
		}

		$permission = 2;
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$rand = random_int(0, 1000);
		$token = md5($username.'+'.$rand);
		$sql = 'INSERT INTO user(username, password, hoten, ngaysinh, email, sdt, token, permission) VALUES (?,?,?,?,?,?,?,?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssssssi',$username, $hash, $fullname, $dateofbirth, $email, $phone, $token, $permission);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return array('code' => 0, 'error' => 'Succesful');
	}

	function send_reset_email($email, $token){
		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
		    $mail->isSMTP();                                            // Send using SMTP
		    $mail->CharSet = 'UTF-8';
		    $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
		    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
		    $mail->Username = 'nhh3103@gmail.com';                     // SMTP username
		    $mail->Password = 'gekduagjlanoemwv';                             // SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		    $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		    //Recipients
		    $mail->setFrom('nhh3103@gmail.com', 'Admin');
		    $mail->addAddress($email, 'Người nhận');     // Add a recipient
		    /*$mail->addAddress('ellen@example.com');               // Name is optional
		    $mail->addReplyTo('info@example.com', 'Information');
		    $mail->addCC('cc@example.com');
		    $mail->addBCC('bcc@example.com');*/

		    // Attachments
		   /* $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');*/    // Optional name

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Recovery your password';
		    $mail->Body    = "Click <a href ='reset_password.php?email=$email&token=$token'>here</a> to recover your password'";
		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    return true;
		} catch (Exception $e) {
		    return false;
		}
	}

	
	function reset_password($email){
		if(!is_email_exists($email)){
			return array('code' => 1, 'error' => 'Email doesnt exists in database');
		}

		$exp = time() + 3600 *24; //hết hạn sau 24h
		$token = md5($email.'+'.random_int(1000,2000));
		$sql = 'update reset_token set token = ?, expire_on = ? where email = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sis',$token, $exp ,$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant execute statement 1');
		}

		if($stm->affected_rows == 0){
			
			$sql = 'insert into reset_token values (?,?,?)';
			$stm = $conn->prepare($sql);
			$stm->bind_param('ssi', $email, $token ,$exp);

			if(!$stm->execute()){
				return array('code' => 2, 'error' => 'Cant execute statement 2');
			}
		}
		
		$success = send_reset_email($email, $token);
		return array('code' => 0, 'success' => $success);
	}

	function update_new_password($email, $password){
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$sql = 'update user set password = ? where email = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ss',$hash,$email);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return array('code' => 0, 'error' => 'Password is changed successfully');
	}

	//Quản lí nhân viên
	function add_staff($fullname,$phone,$email, $address, $position, $gender){
		$sql = 'INSERT INTO nhanvien(TenNV, SDT, Email, DiaChi, ChucVu, GioiTinh) VALUES (?,?,?,?,?,?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssssss',$fullname,$phone,$email, $address, $position, $gender);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return true;
	}

	function delete_staff($id){
		$sql = 'delete from nhanvien where MaNV = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function update_staff($fullname,$phone,$email, $address, $position, $gender, $id){
		$sql = 'UPDATE nhanvien SET TenNV=?,SDT=?, Email=?,DiaChi=?,ChucVu=?, GioiTinh=? WHERE MaNV = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssssssi',$fullname,$phone,$email, $address, $position, $gender, $id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function load_table_staff(){
		$sql = 'SELECT * FROM nhanvien WHERE 1';

		$conn = open_db();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		}
		else{
			return;
		}
	}

	//Quản lí sản phẩm
	function add_product($pruduct_name,$product_type,$price,$producer, $img){
		$sql = 'INSERT INTO sanpham(TenSP, LoaiSP, GiaSP, HangSX, HinhAnh) VALUES (?,?,?,?,?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssiss',$pruduct_name,$product_type,$price,$producer, $img);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return true;
	}

	function delete_product($id){
		$sql = 'delete from sanpham where MaSP = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function update_product($pruduct_name,$product_type,$price,$producer, $img, $id){
		$sql = 'UPDATE sanpham SET TenSP=?, LoaiSP=?, GiaSP=?, HangSX=?, HinhAnh=? WHERE MaSP = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('ssissi',$pruduct_name,$product_type,$price,$producer, $img, $id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function load_table_product(){
		$sql = 'SELECT * FROM sanpham WHERE 1';

		$conn = open_db();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		}
		else{
			return;
		}
	}

	//Quản lí kho
	function add_stock($id_product, $pruduct_name, $quantity, $quantity_sell, $date, $status){
		$sql = 'INSERT INTO kho(MaSP, TenSP, SLTonKho, SLBan, NgayNhap, TrangThai) VALUES (?,?,?,?,?,?)';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('isiiss',$id_product, $pruduct_name, $quantity, $quantity_sell, $date, $status);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return true;
	}

	function delete_stock($id){
		$sql = 'delete from kho where MaKho = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function update_stock($id_product, $pruduct_name, $quantity, $quantity_sell, $date, $status, $id){
		$sql = 'UPDATE kho SET MaSP=?, TenSP=?, SLTonKho=?, SLBan=?, NgayNhap=?, TrangThai=? WHERE MaKho = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('isiissi',$id_product, $pruduct_name, $quantity, $quantity_sell, $date, $status, $id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function load_table_stock(){
		$sql = 'SELECT * FROM kho WHERE 1';

		$conn = open_db();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		}
		else{
			return;
		}
	}

	//Quản lí hóa đơn
	function add_bill($id_staff, $id_customer, $date){
		$sql = 'INSERT INTO hoadon(MaNV, MaKH, NgayNhap, TongTien) VALUES (?,?,?,?)';
		$total = random_int(100000,1000000);

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssi', $id_staff, $id_customer, $date, $total);

		if(!$stm->execute()){
			return array('code' => 2, 'error' => 'Cant Execute');
		}

		return true;
	}

	function delete_bill($id){
		$sql = 'delete from hoadon where MaHD = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('i',$id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function update_bill($id_staff, $id_customer, $date, $id){
		$sql = 'UPDATE hoadon SET MaNV=?, MaKH=?, NgayNhap=? WHERE MaHD = ?';

		$conn = open_db();
		$stm = $conn->prepare($sql);
		$stm->bind_param('sssi',$id_staff, $id_customer, $date, $id);

		if($stm->execute()){
			return true;
		}
		return false;
	}

	function load_table_bill(){
		$sql = 'SELECT * FROM hoadon WHERE 1';

		$conn = open_db();
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			return $result;
		}
		else{
			return;
		}
	}
 ?>