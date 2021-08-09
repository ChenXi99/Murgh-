<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="farm!2.css" rel="stylesheet">
    <title>Monitor</title>
    <style>
    input {
        width: 300px;
        border-radius: 8px;
        border: none;
        padding: 6px 10px;
        margin-right: 16px;
        outline: none;
    }

    button {
        border-radius: 8px;
        border: none;
        padding: 4px 16px;
    }

    button:hover {
        background-color: gray;
        color: #fff;
        cursor: pointer;
    }

    li {
        margin-right: 8px;
    }

    .input-area{
        background-color: orange;
        width: 442px;
        height: 30px;
        padding: 8px;
        margin: 15px;
        border-radius: 8px;
    }

    .incomplete-area{
        background-color: lightyellow;
        border: 1.5px solid grey;
        width: 440px;
        min-height: 180px;
        padding: 8px;
        margin: 15px;
        border-radius: 8px;
    }

    .complete-area{
        background-color: lightyellow;
        border: 1.5px solid grey;
        width: 440px;
        min-height: 180px;
        padding: 8px;
        margin: 15px;
        border-radius: 8px;
    }

    .title {
        text-align: center;
        margin-top: 0;
        font-weight: bold;
        color: #666;
    }

    .list-row {
        display: flex;
        align-items: center;
        padding-bottom: 4px;
    }
    </style>
</head>
<body>

    <!-- Head[Start] -->
    <header>
        <nav class="container_wrap">
          <div class="container">
          <div class="navbar-header"><a class="a_nav" href="../top.html"><img src="../farm.png" class="icon" alt=""></a></div>
          <div class="navbar-header"><a class="a_nav" href="diary.php">Diary</a></div>
          <div class="navbar-header"><a class="a_nav" href="dashboard.php">Dashboard</a></div>
          <div class="navbar-header"><a class="a_nav" href="monitor.php">Monitor</a></div>
          </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->

<h1>To-do</h1>
            <form method="POST" action="" enctype="multipart/form-data">
                
            </form>

    <div class="input-area">
        <input id="add-text" placeholder="enter To-do">
        <button id="add-button">Add</button>
    </div>

    <div class="incomplete-area">
        <p class="title">Yet-finished</p>
        <ul id="incomplete-list">
            <div class="list-row">
            </div>
            <div class="list-row">
            </div>
        </ul>
    </div>

    <div class="complete-area">
        <p class="title">Finished</p>
        <ul id="complete-list">
            <div class="list-row">
            </div>
        </ul>
    </div>

<script>

//テキストボックスの値を取得し、初期化
const onClickAdd = () => {
    const inputText = document.getElementById("add-text").value;
    document.getElementById("add-text").value = "";

    createIncompleteList(inputText);
};

//未完了リストから指定の要素を削除
const deleteFromIncompleteList = (target) => {
    document.getElementById("incomplete-list").removeChild(target);
};

//未完了リストに追加
const createIncompleteList = (text) => {
    // div生成
    const div = document.createElement("div");
    div.className = "list-row";
    
    // liタグ生成
    const li = document.createElement("li");
    li.innerText = text;

    // button(完了)タグ生成
    const completeButton = document.createElement("button");
    completeButton.innerText = "Complete";
    completeButton.addEventListener("click", () => {
        //クリックされた完了ボタンの親タグ(div)を未完了リストから削除
        deleteFromIncompleteList(deleteButton.parentNode);

        // 完了リストに追加する要素
        const addTarget = completeButton.parentNode;
        
        // To-do内容テキストを取得
        const text = addTarget.firstElementChild.innerText;

        // div以下を初期化
        addTarget.textContent = null;
        
        // liタグ生成
        const li = document.createElement("li");
        li.innerText = text;
        
        // buttonタグ生成
        const backButton = document.createElement("button");
        backButton.innerText = "Return";
        backButton.addEventListener("click", () => {
            //クリックされたReturnボタンの親タグ(div)を完了リストから削除
            const deleteTarget = backButton.parentNode;
            document.getElementById("complete-list").removeChild(deleteTarget);

            //テキスト取得
            const text = backButton.parentNode.firstElementChild.innerText;
            createIncompleteList(text);
        });

        // divタグの子要素に各要素を設定
        addTarget.appendChild(li);
        addTarget.appendChild(backButton);
        
        // 完了リストに追加
        document.getElementById("complete-list").appendChild(addTarget);

    });
    
    // button(削除)タグ生成
    const deleteButton = document.createElement("button");
    deleteButton.innerText = "Delete";
    deleteButton.addEventListener("click", () => {
        //クリックされた削除ボタンの親タグ(div)を未完了リストから削除
        deleteFromIncompleteList(deleteButton.parentNode);
    });
    
    // divタグの子要素に各要素を設定
    div.appendChild(li);
    div.appendChild(completeButton);
    div.appendChild(deleteButton);
    
    // 未完了リストに追加
    document.getElementById("incomplete-list").appendChild(div);
};

document.getElementById("add-button")
.addEventListener("click", () => onClickAdd());

</script>
    
</body>
</html>