<!DOCTYPE html>
<html lang="en">
<head>
<style>
body{
    background: linear-gradient(90deg, #DECDBE, #FFF4E1);
}
    
.reservation{
    padding: 20px;
    margin: 30px;
    text-align: center; /* 讓容器內的內容置中 */
    margin: 0 auto; /* 水平居中 */
       
}
.order{
    max-width: 800px;
    max-height: 600px;
    text-align: left; /* 讓容器內的內容置中 */
    margin: 0 auto; /* 水平居中 */
    padding: 10px;
    display: flex;
    justify-content:space-around;
    align-items:center;
    border-radius: 8px;
    background-color: #FDF6E3;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border: 2px solid #8B5E34;
    border-radius: 10px;
}

.order_title{
    font-weight: bold;
    margin-bottom: 20px;
    font-size:35px;
    color:#8B5E34;
    font-family: 'Playfair Display', serif; /* 優雅的字體 */
}
#ordertitle{
    font-weight: bold;
    margin-bottom: 20px;
    font-size:35px;
    color:#8B5E34;
    font-family: 'Playfair Display', serif; /* 優雅的字體 */
}
#error {
    color: #FF0000;
    align-items: center;
    margin-top: 10px;
    display: flex;
    justify-content:center;
}
.error{
    color: #FF0000;
}
.submit-btn{
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center; /* 垂直置中 */
    gap: 10px; /* 按鈕間距 */

}
#submit-btn{
    background-color: #A67C52;
    color: #ffffff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    justify-content: space-between;
}
#order_Info{
    max-width: 200px;
    max-height: 600px;
    background: #f8e5c3f6;
    text-align: center;
    padding: 10px;
    display: flex;
    justify-content:space-around;
    align-items: center;
    border-radius: 8px;
}
#Infotitle{
    font-weight: bold;
    text-align: center;
    font-size:20px;
    color:#8B5E34;
    margin-top: 5px;
    font-family: 'Playfair Display', serif; /* 優雅的字體 */
}
/* 訂位資訊容器 */
.reservation-info {
    font-family: 'Arial', sans-serif;
    margin: 20px auto;
    padding: 20px;
    border: 2px solid #8B5E34;
    border-radius: 10px;
    max-width: 800px;
    background-color: #FDF6E3; /* 柔和的背景色 */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* 增加陰影 */
}

/* 標題樣式 */
.reservation-info h2 {
    text-align: center;
    color: #8B5E34; /* 咖啡色調 */
    font-weight: bold;
    margin-bottom: 15px;
}

/* 訂位資訊容器 */
.info-container {
    display: flex;
    flex-wrap: wrap; /* 子項目可以換行 */
    justify-content: space-between;
    gap: 10px;
    margin-top: 10px;
}

/* 單個資訊項目樣式 */
.info-item {
    flex: 1 1 30%; /* 每個項目占據 30% 空間，隨視窗自適應 */
    font-size: 18px;
    color: #333; /* 深灰色字體 */
    margin: 5px 0;
}

/* 強調字詞樣式 */
.info-item strong {
    color: #8B5E34; /* 咖啡色 */
}

.submit-btn{
    background-color: #A67C52;
    color: #ffffff;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}
/* 懸浮按鈕的樣式 */
.floating-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    font-size: 36px;
    color: #ffffff;
    background-color: #8d6e63;
    width: 80px;
    height: 80px;
    border-radius: 50%;
    text-align: center;
    line-height: 80px;
    text-decoration: none;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    z-index: 1000;
    user-select: none; /* 禁止選中文字 */
}

.floating-button:hover {
    background-color: #5d4037;
    transform: scale(1.15);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
}

.floating-button:active {
    transform: scale(1); /* 點擊時略微回彈 */
}
#homeButton {
    right: 20px;
}

</style>
</head>
<body>
<?php
    // 初始化變數
    $name = $phone = $date = $time = $comment = $guests ="";
    $nameErr = $phoneErr = $dateErr = $timeErr = $guestsErr ="";
    $isSubmitted = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "姓名必填!";
        } else {
        $name = test_input($_POST["name"]);
        }
    
        if (empty($_POST["phone"])) {
            $phoneErr = "手機號碼必填";
        } else {
            $phone = test_input($_POST["phone"]);
        }

        if (empty($_POST["date"])) {
            $dateErr = "訂位日期必填";
        } else {
            $date = test_input($_POST["date"]);
        }

        if (empty($_POST["time"])) {
            $timeErr = "訂位時間必填";
        } else {
            $time = test_input($_POST["time"]);
        }

        if (empty($_POST["comment"])) {
            $comment = "";
        } else {
            $comment = test_input($_POST["comment"]);
        }

        if (empty($_POST["guests"])) {
            $guestsErr = "訂位人數必填";
        } else {
            $guests = test_input($_POST["guests"]);
        }
        $isSubmitted = true;
    }

    // 輔助函數：清理輸入資料
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<div class="reservation">
    <h2 class = "order_title">☕ 咖啡廳</h2>
    <div class="order">
        <div>
            <p><span id="ordertitle">❗線上訂位❗</span></p>
        <p><span id="error">*為必填項目</span></p>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            姓名: <input type="text" name="name" required>
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            手機號碼: <input type="tel" name="phone" required>
            <span class="error">* <?php echo $phoneErr;?></span>
            <br><br>
            日期: <input type="date" name="date" required>
            <span class="error">* <?php echo $dateErr;?></span>
            <br><br>
            時間: <input type="time" name="time" required>
            <span class="error">* <?php echo $timeErr;?></span>
            <br><br>
            備註: <textarea name="comment" rows="5" cols="40"></textarea>
            <br><br>
            用餐人數:<input  type="number" name="guests" min="1" required>
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            <input class="submit-btn" type="submit" name="submit" value="確認訂位">
        </form>
    </div>
    <div class="floating-button"  id="homeButton" onclick="window.location.href='home.html'">🏠</div>
</div>

<!-- 顯示提交的結果 -->
<?php if ($isSubmitted): ?>
<div class="reservation-info">
    <h2>您的訂位資訊:</h2>
    <div class="info-container">
        <div class="info-item"><strong>姓名:</strong> <?php echo $name; ?></div>
        <div class="info-item"><strong>手機號碼:</strong> <?php echo $phone; ?></div>
        <div class="info-item"><strong>日期:</strong> <?php echo $date; ?></div>
        <div class="info-item"><strong>時間:</strong> <?php echo $time; ?></div>
        <div class="info-item"><strong>備註:</strong> <?php echo $comment; ?></div>
        <div class="info-item"><strong>用餐人數:</strong> <?php echo $guests; ?></div>
    </div>
</div>
<?php endif; ?>

</body>
</html>
