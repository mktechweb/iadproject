<div class="row">
    <div class="logout col-md-4">
    </div>
    <div class="col-md-4 text-center">
        <h1>Welcome on ChatIAD <?=$_SESSION['login']?></h1>
    </div>
    <div class="col-md-4"></div>
</div>

<div class="row">
    <div class="col-md-4">
        <?=$_SESSION['login']?> | <a href="/chat/logout">Logout</a>
        <h2>Connected users</h2>
        <ul id="users" class="list-group"></ul>
    </div>
    <div class="col-md-4">
        <div class="row">
            <form method="post" class="form-group">
                <div class="col-md-10">
                    <input type="text" class="form-control" placeholder="Enter your message" name="content">
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" name="Send" value="Send">
                </div>
            </form>
        </div>
        <div>
            <ul id="messages" class="list-group"></ul>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    refresh();

    setInterval(
        function () {
            refresh();
        }, 3000
    );

    function refresh() {

        $.ajax({
            type : "POST",
            dataType : "json",
            url : "/chat/checkConnection",
            success : function(data) {
                $("#users").empty();
                for (result in data) {
                    $("#users").append('<li class="list-group-item">' + data[result] + '</li>');
                }
            }
        });

    	$.ajax({
            type : "POST",
            dataType : "json",
            url : "/chat/refresh",
            success : function(data) {
                console.log(data);
            	$("#messages").empty();
            	for (result in data) {
            	    console.log(data);
					$("#messages").prepend('<li class="list-group-item"><strong>'
                        + data[result].user + '</strong> :'
                        + data[result].content
                        + '<br /><i class="far fa-clock"></i> <em>'
                        + data[result].datetime  + '</em></li>');
            	}
            }
        });

    }
</script>