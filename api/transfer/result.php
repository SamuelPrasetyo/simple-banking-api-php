<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="number"] {
            width: calc(100% - 22px); /* Adjusted width to accommodate padding and border */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: calc(100% - 22px); /* Adjusted width to accommodate padding and border */
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        </style>
</head>
<body>
<?php
    include '../include/header.php';
    include '../../koneksi.php';
?>
<div class="container">
<?php 
  if(isset($_POST['form_submitted'])){

    //These variables are collecting form data
      $PAYER_ID = $_POST['no_rekpengirim'];
      $PAYEE_ID = $_POST['no_rekpenerima'];
      $AMOUNT = $_POST['jumlah_transfer'];

      if(empty($PAYER_ID) || empty($PAYER_ID) || empty($AMOUNT)){        
        echo "<script> alert('Empty Fields !!');
        window.location.href='../transfer/transfer.php';
        </script>";  
        exit() ;           
      }

      //CHECK IF AMOUNT IS GREATER THAN 0 OR NOT
      if($AMOUNT <=0){
        echo "<script> alert('Jumlah harus lebih besar dari nol !!');
        window.location.href='../transfer/transfer.php';
        </script>";  
        exit() ;  
      }

      if(!ctype_digit($AMOUNT) || !ctype_digit($PAYER_ID) || !ctype_digit($PAYEE_ID)){
        echo "<script> alert('Nilai yang dimasukkan hanya dapat berisi digit!!');
        window.location.href='../transfer/transfer.php';
        </script>";  
        exit() ;  
      }

      //CHECK IF PAYER ID EXISTS OR NOT
      $sqlcount = "SELECT COUNT(1) FROM rekening where no_rekening='$PAYER_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('Rekening Pembayar tidak ada !!');
        window.location.href='../transfer/transfer.php';
        </script>";  
        exit() ;      
      }
    
      //CHECK IF PAYEE ID EXISTS OR NOT
      $sqlcount = "SELECT COUNT(1) FROM rekening where no_rekening='$PAYER_ID'";
      $r =  $conn->query($sqlcount);
      $d = $r->fetch_row();
      if($d[0]<1){
        echo "<script> alert('rekening Penerima Pembayaran tidak ada !!');
        window.location.href='../transfer/transfer.php';
        </script>";  
        exit() ;      
      }
      
      //CHECK IF PAYER HAS SUFFICIENT MONEY OR NOT
      $sql = "Select * from rekening where no_rekening='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
               if($row1['saldo']<$AMOUNT){
                echo "<script> alert('Pembayar tidak memiliki saldo yang diperlukan !!');
                window.location.href='../transfer/transfer.php';
                </script>";  
                exit() ; 
                }  
          }  

   
      //THIS ELSE CODE BELOW IS PERFORMING TRANSACTION FROM PAYER AND PAYEE BANK ACCOUNTS
      //BELOW CODE RUNS WHEN ALL DETAILS ENTERED BY USER ARE CORRECT OR NOT

          echo "<div class ='center'>";
          echo "<div class ='center2'>";
          echo "<h1 style='text-align: center'>Transaksi Transfer Anda telah Berhasil</h1>
                <p  style='text-align: center; font-size:25px;'>Detail Pengirim dan Penerima di bawah:<p>
                <table id = 'Table'>
                <tr>
                <th></th>
                <th>No Rekening</th>
                <th>Nama Nasabah</th>
               
                </tr>";

          //SELECTING PAYER DETAILS FROM ACCOUNTDETAILS TABLE
          $sql = "Select * from rekening where no_rekening='$PAYER_ID'";       
          if($result = $conn->query($sql)){            
               $row1 = $result->fetch_array(); 
                //row1 contains payer details
                       echo "<tr> 
                            <td> Pengirim </td>
                            <td>".$row1['no_rekening']."</td>
                            <td>".$row1['nama_nasabah']."</td>
                           
                            </tr>";                        
                       $PayerCurrentBalance = $row1['saldo'];            
            }
        
          //SELECTING PAYEE DETAILS FROM ACCOUNTDETAILS TABLE
          $sql2 = "Select * from rekening where no_rekening='$PAYEE_ID'";
          if($result = $conn->query($sql2)){
                //row2 contains payee details
                $row2 = $result->fetch_array();
                       echo "<tr> 
                            <td> Penerima </td>
                            <td>".$row2['no_rekening']."</td>
                            <td>".$row2['nama_nasabah']."</td>
                           
                            </tr>"; 
                        $PayeeCurrentBalance = $row2['saldo'];                       
               
               
            }               
            echo "</table>";
            $PayeeCurrentBalance += $AMOUNT;
            $PayerCurrentBalance -= $AMOUNT;
            echo "<br>";
            echo "<table id = 'Table' style='margin-bottom:15px;'>
                    <tr>
                        <th></th>
                        <th>Saldo lama</th>
                        <th>Saldo Terbaru</th>
                    </tr>
                    <tr>
                        <th>Pengirim</th>
                        <td style='color:black'>".$row1['saldo']."</td>                        
                        <td style='color:black'>".$PayerCurrentBalance."</td>
                    </tr>
                    <tr>
                        <th>Penerima</th>
                        <td style='color:black'>".$row2['saldo']."</td>                        
                        <td style='color:black'>".$PayeeCurrentBalance."</td>
                    </tr>";
            echo "</table>";

           //FOR UPDATING DETAILS OF PAYER
           $updatepayer ="Update rekening set saldo='$PayerCurrentBalance' where no_rekening='$PAYER_ID'";
           //FOR UPDATING DETAILS OF PAYEE
           $updatepayee ="Update rekening set saldo='$PayeeCurrentBalance' where no_rekening='$PAYEE_ID'";

           //CHECK IF PAYER DETAILS ARE UPADTED OR NOT 
           if($conn->query($updatepayer)==true){
                ?>         
                <script>console.log("DETAIL PEMBAYAR DIPERBARUI!!")</script>
                <?php
           }
           else{
                ?>        
                <script>alert("DETAIL PEMBAYAR TIDAK DIPERBARUI!!")</script>
                <?php
           }

           //CHECK IF PAYEE DETAILS ARE UPADTED OR NOT 
           if($conn->query($updatepayee)==true){
                    ?>         
                    <script>console.log("DETAIL PENERIMA PEMBAYARAN DIPERBARUI! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("DETAIL PENERIMA PEMBAYARAN TIDAK DIPERBARUI! KESALAHAN TERJADI!")</script>
                    <?php
            }

            //SETTING TIME ZONE
            date_default_timezone_set('Asia/Kolkata');           
            $date = date('Y-m-d H:i:s',time());
            //echo "Current time is : ".$date;

            //FOR UPDATING HISTORY TABLE WHICH MAINTAINS RECORDS OF ALL TRANSACTIONS
            $InsertTransactTable ="Insert into transfer (nama_pengirim, no_rekpengirim, nama_penerima, no_rekpenerima, jumlah_transfer, time) values ('$row1[nama_nasabah]','$row1[no_rekening]','$row2[nama_nasabah]','$row2[no_rekening]','$AMOUNT','$date')";
            //EXECUTING INSERT COMMAND AND CHECKING IF INSERTION WAS SUCCESSULL OR NOT
            if($conn->query($InsertTransactTable)==true){
                    ?>         
                    <script>console.log("Catat transaksi ini disimpan! ")</script>
                    <?php
            }
            else{
                    ?>        
                    <script>alert("Catat transaksi ini disimpan! KESALAHAN TERJADI!")</script>
                    <?php
            }


            echo "<br>";
        echo "</div>";
        echo "</div>";
   
  }else{
      ?>
      <h1>Semua transaksi adalah yang terbaru</h1>
      <?php
  }
  $conn->close();
?>
 
             
 </div>

</body>
</html>

