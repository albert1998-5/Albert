<?php
session_start();
/*路徑*/
/* 客戶端 */
$root_cust = "/bookstore";
/* 預設為空 */
// $root_cust = "";
/* 本機端 */
$root_local = $_SERVER['DOCUMENT_ROOT'] . $root_cust;
?>

<?php
//引入檔案
require_once($root_local."/Connections/connSQL.php");
require_once($root_local."/script/script.php");

// UID鍵入
// $UID = "20210121";
// $username = "安安，";
// $_SESSION['UID'] = $UID;
// $_SESSION['username'] = $username;





// 接收P_ID
// $str = $_SERVER['QUERY_STRING'];
// $id = substr($str, 5,8);
$P_ID = $_GET['P_ID'];


// 顯示書籍資料
$query = sprintf("SELECT * FROM `products`, `type_list` WHERE products.P_type_id= type_list.P_type_id AND products.P_ID = %d", $P_ID);
$result = mysqli_query($link, $query) or die("Error: " . mysqli_error($link));
$data = mysqli_fetch_array($result);


// *************測試中****************判斷是否登入，是則加入購物車程式，否則跳轉至登入頁面
if (isset($_GET['buy']) and $_GET['buy'] != "") {
//     if(isset($_SESSION['UID'])==""){?>
         <script type="text/javascript">
//             alert('請先登入會員');
//             location.href = "results/cart/cart.php";
//         </script>
     <?php 
//     }else{
//         $UID = $_SESSION['UID'];
//         $qty = $_GET['qty'];
//         // $insertGoTo = "../cart/cart.php";
//         $insertSQL = sprintf("INSERT INTO cart (UID, P_ID, qty) VALUES ('%s','%s','%s')", $UID, $P_ID, $qty);
//         $result_add = mysqli_query($link, $insertSQL);
//         // header(sprintf("Location: %s", $insertGoTo));
//     }
// }



// 加入購物車程式
//若ip有傳值，且值不為空值的話則續做下列動作 
if (isset($_GET['buy']) and $_GET['buy'] != "") {
    $UID = $_SESSION['UID'];
    $qty = $_GET['qty'];
    // $insertGoTo = "../cart/cart.php";
    $insertSQL = sprintf("INSERT INTO cart (UID, P_ID, qty) VALUES ('%s','%s','%s')", $UID, $P_ID, $qty);
    $result_add = mysqli_query($link, $insertSQL);
    // header(sprintf("Location: %s", $insertGoTo));
}

?>


<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>南波灣書局</title>

    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="<?php echo $root_cust; ?>/main_flex.css">
    <link rel="stylesheet" href="product.css">

    <!-- 楷書體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@300;500;700&display=swap" rel="stylesheet">
    <!-- 正黑體 -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo $root_cust; ?>/images/book-2.png">
    <link rel="bookmark" href="<?php echo $root_cust; ?>/images/book-2.png">

    <!-- JS 跳出視窗 -->
    <script type="text/javascript">
        function MM_popupMsg(msg) { //v1.0
            alert(msg);
        }
    </script>

    <!-- ***測試中***加入購物車>是否登入判斷 -->
    <script type="text/javascript">
        function join_cart(){
            let strSession = "<%=Session['UID'] %>".toString(); 
            if( strSession == "")
            {
                alert('請先登入');
                // location.href = "login.php";
                return false;
            }else{
                alert('商品已放入購物車!!');
                return true;
            }
        }
    </script>
</head>

<body>
    <!-- header -->
    <?php require_once($root_local."/parts/header.php"); ?>

    <!-- 主體 -->
    <div id="content">
        <div id="main">
            <p>
            <div><a href="<?php echo $root_cust; ?>/index.html">　　南波灣書局</a> > <a href=""><?php echo $data['P_type_name'] ?></a> > 商品介紹</div>

            <div class="productBook">

                <!-- 書本資料 -->
                <div class="picture"><img src="<?php echo $root_cust; ?>/images/product/<?php echo $data['P_ID']; ?>_1.jpg"></div>
                <div class="productContent1">
                    <h4><?php echo $data['P_name']; ?></h4>
                    作者：<?php echo $data['P_author']; ?> <br>
                    出版社：商業周刊 <br>
                    出版日期：<?php echo $data['P_data']; ?> <br>
                    定價：<?php echo $data['P_price']; ?>元 <br>
                    優惠價：<span>79</span> 折<span>284</span>元 <br>
                    運送方式：限定宅配 <br>
                </div>

                <!-- 購物車 -->
                <form action="product.php" method="GET" enctype="multipart/form-data" name="buy">
                    <center>
                        <div class="shoppingCart">
                            <div>
                                <img src="<?php echo $root_cust; ?>/images/shopping_cart.png"><br>庫存><span>10</span>
                            </div>
                            <br>
                            購買： <select name="qty" id="qty">
                                <?php
                                for ($a = 1; $a <= 10; $a++) {
                                    echo "<option value='" . $a . "'>" . $a . "</option>";
                                }
                                ?>
                            </select> 本
                            <br>

                            <!-- 傳送P_ID及IP -->
                            <input type="hidden" name="P_ID" value="<?php echo $P_ID; ?>">
                            <input type="hidden" name="buy" value="go">
                            <!-- end -->

                            <input class="cartButton1" type="submit" value="放入購物車"  onclick="join_cart()">
                            <input class="cartButton2" type="submit" value="直接結帳">
                        </div>
                    </center>
                </form>
                <!-- 購物車 end -->


                <div class="productContent2">
                    <h3>內容簡介</h3>
                    <hr>
                    <h4>
                        四十歲以下理財讀者必讀的書，充滿了智慧和實用建議──亞馬遜讀者一致盛讚想要投資致富，又不想天天看盤、日日操煩，身累心也累，該怎麼做？
                    </h4>
                    <h4>
                        財經暢銷作家麥可．勒巴夫教你
                        既能賺飽錢，也能過上理想人生的祕密：
                        全世界最簡單的「勒巴夫定律」──
                        積極主動地投資自己的人生，被動地投資金錢。
                        你將享受財富與一生無憂的幸福。
                    </h4>
                    <p>
                        沒有人不愛錢、不需要錢，但如果只花在加班賺錢和鑽研投資上，人生是不是少了心安和幸福——享受自由閒適的時間、學一門樂趣盎然的技藝、陪伴逐漸年邁的爸媽、和孩子好好相處、保養身心健康、來場放鬆的旅遊……都是不可割捨的幸福快樂。你得好好掌握，別讓滿心賺錢驅走你的幸福。
                    </p>
                    <p>
                        別擔心，暢銷財經作家麥可．勒巴夫將歷久不衰的投資智慧、與時俱進的理財知識，以及人生愜意自在的方法寫成《賺錢，也賺幸福》。
                    </p>
                    <p>
                        本書被譽為「四十歲以下理財讀者必讀的書」，幫助理財新手、小資男女、想打基礎的讀者，盤點金錢與人生的相關課題。身上有錢、生活豐富、時間從容，是勒巴夫要在這本書解開的祕密。
                        其實很簡單，你一定做得到！就是全世界最簡單的「勒巴夫定律」：積極主動地投資自己的人生，被動地投資金錢。
                    </p>
                    <p>
                        主動積極投資自己的人生：自己決定時間要如何分配，而不是根據別人的指示。
                        檢視你要的生活與夢想，什麼是對你最重要的，然後決心花時間改變，就能擺脫現狀，成為自己想當的那種人。被動地投資金錢：將投資主要放在沒什麼精神負擔、成本低、能反映整體股市表現的指數型基金（即被動式投資），這種不花腦筋、不花時間的投資法，表現得會比那些要收費替你管理資金的投資專家還好。最棒的是：人人都做得來。
                    </p>
                    <p>
                        聽來簡單，為什麼說這是個祕密？因為大部分人都在做相反的事情：被動的投資人生、積極主動投資金錢。花了大把時間企圖戰勝市場，煩惱該買什麼、什麼時候買，什麼時候賣，隨時處於壓力過大的狀況，獲得得報酬卻不如損失的時間、健康與睡眠……。
                    </p>

                    <h3>作者介紹</h3>
                    <hr>
                    <h4>作者簡介</h4>
                    <h4>麥可．勒巴夫（Michael LeBoeuf）</h4>
                    <p>
                        曾擔任商學院教授，35歲時體認有錢很重要，但有自己的人生更重要，因此找出如何又賺到錢、又賺得幸福的真正富裕之道，並身體力行。結果在1989年的47歲從教職退休，靠累積的財富活得愜意。他追隨先鋒（Vanguard）的創辦人約翰．柏格（John
                        Bogle）推行指數化投資，身為柏格頭（Bogleheads，景仰柏格先生的投資人自主組織）的領導人物，合著有暢銷著作《柏格頭投資指南》。另著有《別當打卡的豬》、《效率專家》、《如何永遠贏得顧客》、《21世紀管理新觀念》、《生產力挑戰》、《做時間的主人》等書。
                    </p>
                    <h4>譯者簡介</h4>
                    <h4>李振昌</h4>
                    <p>
                        政大歷史系畢業，美國肯塔基州默海德州立大學（Morehead State University）大眾傳播學碩士。曾任中國生產力中心叢書主編與經理、讀者文摘叢書主編及良辰出版公司總編輯。
                    </p>

                    <h3>詳細資料</h3>
                    <hr>
                    <p>
                        ISBN：9789867778949 <br>
                        叢書系列：藍學堂 <br>
                        規格：平裝 / 288頁 / 17 x 22 x 1.44 cm / 普通級 / 單色印刷 / 初版 <br>
                        出版地：台灣 <br>
                    </p>

                    <h3>購物說明</h3>
                    <hr>
                    <p>若您具有法人身份為常態性且大量購書者，或有特殊作業需求，建議您可洽詢「企業採購」。</p>
                    <h4>退換貨說明 </h4>
                    <p>會員所購買的商品均享有到貨十天的猶豫期（含例假日）。退回之商品必須於猶豫期內寄回。 </p>
                    <p>辦理退換貨時，商品必須是全新狀態與完整包裝(請注意保持商品本體、配件、贈品、保證書、原廠包裝及所有附隨文件或資料的完整性，切勿缺漏任何配件或損毀原廠外盒)。退回商品無法回復原狀者，恐將影響退貨權益或需負擔部分費用。 </p><br>
                    <p>
                        <center><a href="#TOP">TOP</a></center>
                    </p>

                </div>
                <div class="space"></div>

            </div>
        </div>
    </div>

    <!-- 頁尾 -->
    <div id="footer">
        Copyright © since 2020 No.1 books.com.tw All Rights Reserved.
    </div>

</body>

</html>