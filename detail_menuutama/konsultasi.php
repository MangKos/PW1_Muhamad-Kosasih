<?php
session_start();

if (!isset($_SESSION['chat'])) {
    $_SESSION['chat'] = [];
}

$balasanPilihan = [
    "Saya lagi stres" => "Terima kasih sudah jujur. Boleh diceritakan, stresnya lebih ke pekerjaan atau hal lain?",
    "Saya capek banget" => "Capek secara fisik atau lebih ke pikiran? Aku ingin memahami kondisimu.",
    "Saya sedih" => "Aku ikut merasakan kesedihanmu. Sejak kapan kamu merasa seperti ini?",
    "Saya bingung harus gimana" => "Kebingungan memang berat. Masalah apa yang sedang paling kamu pikirkan sekarang?"
];

$balasanRandom = [
    "Aku mendengarkan. Ceritakan lebih lanjut ya.",
    "Terima kasih sudah berbagi. Aku di sini untukmu.",
    "Boleh kamu jelaskan lebih detail supaya aku lebih memahami?",
    "Perasaan seperti itu wajar. Apa yang paling mengganggumu saat ini?"
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pesan = trim($_POST['pesan']);

    if ($pesan !== '') {
        $_SESSION['chat'][] = ['from'=>'user','text'=>htmlspecialchars($pesan)];
        $reply = $balasanPilihan[$pesan] ?? $balasanRandom[array_rand($balasanRandom)];
        $_SESSION['chat'][] = ['from'=>'bot','text'=>$reply];
        echo json_encode($reply);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Konsultasi Online</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background:#f1f3f6;
    font-family: "Segoe UI", Arial, sans-serif;
}

/* ===== DESKTOP WRAPPER ===== */
.chat-container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.chat-panel {
    width: 980px;
    height: 85vh;
    background: #fff;
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,.12);
    overflow: hidden;
}

/* ===== HEADER ===== */
.chat-header {
    padding: 14px 20px;
    border-bottom: 1px solid #ddd;
    background: #ffffff;
}
.chat-header h6 {
    margin: 0;
    font-weight: 600;
}
.chat-header small {
    color: #6c757d;
}

/* ===== CHAT AREA ===== */
.chat-body {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #eef1f5;
}

.msg {
    max-width: 65%;
    padding: 10px 14px;
    margin-bottom: 12px;
    font-size: 14px;
    line-height: 1.45;
    border-radius: 6px;
}

/* user */
.msg.user {
    margin-left: auto;
    background: #0d6efd;
    color: #fff;
}

/* konselor */
.msg.bot {
    background: #fff;
    border: 1px solid #dcdcdc;
}

/* typing */
.typing {
    font-size: 13px;
    color: #666;
    font-style: italic;
    margin-bottom: 10px;
}

/* ===== QUICK BUTTON ===== */
.quick {
    padding: 10px 20px;
    border-top: 1px solid #ddd;
    background: #fafafa;
}
.quick button {
    font-size: 13px;
    margin: 3px;
}

/* ===== INPUT ===== */
.chat-input {
    display: flex;
    padding: 14px 20px;
    border-top: 1px solid #ddd;
    background: #ffffff;
}
.chat-input input {
    font-size: 14px;
    border-radius: 4px;
}
.chat-input button {
    margin-left: 8px;
    padding: 0 20px;
    border-radius: 4px;
}
</style>
</head>

<body>

<div class="chat-container">
<div class="chat-panel">

    <div class="chat-header">
        <h6>Konsultasi Online</h6>
    </div>

    <div class="chat-body" id="chat">
        <?php foreach($_SESSION['chat'] as $c): ?>
            <div class="msg <?= $c['from']=='user'?'user':'bot' ?>">
                <?= $c['text'] ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="quick">
        <button class="btn btn-outline-primary btn-sm" onclick="sendMsg('Saya lagi stres')">Saya lagi stres</button>
        <button class="btn btn-outline-primary btn-sm" onclick="sendMsg('Saya capek banget')">Saya capek banget</button>
        <button class="btn btn-outline-primary btn-sm" onclick="sendMsg('Saya sedih')">Saya sedih</button>
        <button class="btn btn-outline-primary btn-sm" onclick="sendMsg('Saya bingung harus gimana')">Saya bingung harus gimana</button>
    </div>

    <form class="chat-input" onsubmit="event.preventDefault(); sendMsg(input.value); input.value=''">
        <input type="text" id="input" class="form-control" placeholder="Ketik pesan Anda..." required>
        <button class="btn btn-primary">Kirim</button>
    </form>

</div>
</div>

<script>
const chat = document.getElementById("chat");
function bottom(){ chat.scrollTop = chat.scrollHeight; }
bottom();

function sendMsg(text){
    if(!text) return;

    chat.insertAdjacentHTML("beforeend",
        `<div class="msg user">${text}</div>`
    );
    bottom();

    const typing = document.createElement("div");
    typing.className = "typing";
    typing.innerText = "Konselor sedang mengetik...";
    chat.appendChild(typing);
    bottom();

    const data = new FormData();
    data.append("pesan", text);

    fetch("",{method:"POST",body:data})
    .then(r=>r.json())
    .then(res=>{
        setTimeout(()=>{
            typing.remove();
            chat.insertAdjacentHTML("beforeend",
                `<div class="msg bot">${res}</div>`
            );
            bottom();
        },1300);
    });
}
</script>

</body>
</html>
