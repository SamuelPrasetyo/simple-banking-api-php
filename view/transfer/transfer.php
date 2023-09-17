<!DOCTYPE html>
<html>
<head>
<style>
 body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
  }

  .transferuang {
    text-align: center;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .transferuang h1 {
    color: #333333;
    margin-bottom: 20px;
  }

  table {
    width: 100%;
  }

  table tr td {
    padding: 10px 0;
  }

  input[type="number"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    background-color: #007BFF;
    color: #ffffff;
    font-size: 16px;
    cursor: pointer;
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
<div class="transferuang">
    <h1>Transfer Uang</h1>
    <form name="myForm" action="../transfer/result.php" onsubmit="return validateForm()" method="post">
        <table id="table1">
        <tr>
            <td>No Rek Pengirim</td>
            <td><input type="number" name="no_rekpengirim" min=100 required></td>
        </tr>
        <tr>
            <td>No Rek Penerima</td>
            <td><input type="number" name="no_rekpenerima" min=100 required ></td>
        </tr>
        <tr>
            <td>Jumlah (Rp)</td>
            <td><input type="number" name="jumlah_transfer" min=1 required></td>
        </tr>
        <tr>
            <td><input type="hidden" name="form_submitted" value="1"></td>
            <td><input type="submit" value="PROSES"></td>
        </tr>
        </table>
    </form>
</div>
 <script>
 
 function validateForm() {
            var x = document.forms["myForm"]["no_rekpengirim"].value;
            var y = document.forms["myForm"]["no_rekpenerima"].value;
            var z = document.forms["myForm"]["jumlah_transfer"].value;
            var regex=/^[0-9]+$/;

            
            if (x == "" || y=="" || z=="") {
                alert("Fill it!!");
                return false;
            }

            if((Math.sign(z)==-1)||(Math.sign(z)==-0)||z==0){
                alert("Masukkan jumlah yang valid untuk melakukan transaksi");
                return false;
            }
            if(isNaN(z)|| !x.match(regex)|| !y.match(regex) ||!z.match(regex)){
                alert("Enter correct input!");
                return false;
            }
            
        }
            
 </script>
</body>
</html>
