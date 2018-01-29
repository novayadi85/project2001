<?php
	if(isset($_SESSION['notice'])){

		$notice=$_SESSION['notice'];
		// Notice Berupa Error
		if($notice <= 200){
			
			switch($notice){
				case 101 :
				$pesan="Failed to Add & Save Your Data !";
				break;
				case 102 :
				$pesan="Failed to Update Your Data !";
				break;
				case 103 :
				$pesan="Failed to Delete Your Data !";
				break;
				case 104:
				$pesan="Invalid Username Or Password !";
				break;
				case 105:
				$pesan="Failed to Change Admin Level !";
				break;
				case 106:
				$pesan="Failed to Change Your Password !";
				break;
				case 107:
				$pesan="Failed to Update Your Profile !";
				break;
				case 108:
				$pesan="Failed to Update Settings !";
				break;
				case 109:
				$pesan="Failed To Posting TUG!";
				break;
				case 110:
				$pesan="Stok Barang Tidak Mencukupi !";
				break;
				case 111:
				$pesan="Failed To Remove The Blacklist !";
				break;
				case 112:
				$pesan="Laporan Gagal Terkirim !";
				break;
				case 113:
				$pesan="Gagal Update Stok, Stok Baru Masih Sama Denan Stok Lama !";
				break;
				case 114:
				$pesan="Failed To Pay Deposit, Please Try Again !";
				break;
				case 115:
				$pesan="Failed To Delete The Transaction !";
				break;
				case 116:
				$pesan="Cannot Add Transaction, The Guest Has Reach The Maximum Credit Limit !";
				break;
				case 117:
				$pesan="Cannot Change Room No ! Error Room Amandement ";
				break;
				case 118:
				$pesan="Payment Error ! Wrong Password For Responsible Person ";
				break;
				case 119:
				$pesan="Failed To Change Booking Status !";
				break;
				case 120:
				$pesan="Failed To Change Payment Status !";
				break;
				case 121:
				$pesan="Failed To Uncheck-In The Room !";
				break;
				case 122:
				$pesan="Failed To Check-Out The Room !";
				break;
				case 123:
				$pesan="Failed To Uncheck-Out The Room !";
				break;
				case 124:
				$pesan="Failed To Added Reservation !";
				break;
				case 125:
				$pesan="Failed To Update Reservation !";
				break;
				case 126:
				$pesan="Failed To Make Payment !";
				break;
				case 127:
				$pesan="Failed To Added Transaction !";
				break;
				case 128:
				$pesan="Failed To Delete Transaction !";
				break;
				case 129:
				$pesan="Failed To Make Payment !";
				break;
			}

		// Notice Berupa Peringatan / Warning
		}else if($notice <= 300){

	    	switch($notice){
				case 201:
				$pesan="Jumlah Material Yang Diterima Melebihi Jumlah Yang Diorder !";
				break;
				case 202:
				$pesan="Upps.... Just ".$_SESSION['jml_room_cat']." Rooms Available For ".$_SESSION['nama_room_cat']." Category !";
				break;
				case 203:
				$pesan="Upps.... Cash Amount Cannot Be Less Than Total Bill !";
				break;
			}


		// Notice Sukses
		}else if($notice <= 400){

	    	switch($notice){
				case 301:
				$pesan="Data Has Been Added & Saved Succesfully";
				break;
				case 302 :
				$pesan="Data Has Been Saved Succesfully";
				break;
				case 303 :
				$pesan="Data Has Been Deleted Succesfully";
				break;
				case 305 :
				$pesan="Admin Level Succesfully Changed";
				break;
				case 306 :
				$pesan="Succesfully Changed Your Password";
				break;
				case 307 :
				$pesan="Succesfully Update Your Profile";
				break;
				case 308 :
				$pesan="Succesfully To";
				break;
				case 309 :
				$pesan="Succesfully To Posting TUG";
				break;
				case 310 :
				$pesan="Succesfully Change Settings";
				break;
				case 311 :
				$pesan="Succesfully Add Into Blacklist";
				break;
				case 312 :
				$pesan="Laporan Berhasil Terkirim ";
				break;
				case 313 :
				$pesan="Blacklist Succesfully Has Been Removed Succesfully !";
				break;
				case 314 :
				$pesan="Check-In Succesfully !";
				break;
				case 315 :
				$pesan="Deposit Paid Succesfully !";
				break;
				case 316 :
				$pesan="Transaction Has Been Added Succesfully !";
				break;
				case 317 :
				$pesan="Transaction Has Been Deleted Succesfully !";
				break;
				case 318 :
				$pesan="Room No Has Been Changed Succesfully !";
				break;
				case 319 :
				$pesan="All Setting Updated Succesfully !";
				break;
				case 320 :
				$pesan="Booking Status Updated Succesfully !";
				break;
				case 321 :
				$pesan="Payment Status Updated Succesfully !";
				break;
				case 322 :
				$pesan="The Room Has Been Uncheck-In Succesfully !";
				break;
				case 323 :
				$pesan="Check-Out Succesfully !";
				break;
				case 324 :
				$pesan="The Room Has Been Uncheck-Out Succesfully !";
				break;
				case 325 :
				$pesan="New Reservation Added Succesfully !";
				break;
				case 326 :
				$pesan="Update Reservation Succesfully !";
				break;
				case 327 :
				$pesan="Make Paymant Succesfully, Guest Has Been Checked-Out !";
				break;
				case 328 :
				$pesan="Make Paymant Succesfully !";
				break;

			}

		}

		echo $pesan;
	}

	unset($_SESSION['notice']);
?>