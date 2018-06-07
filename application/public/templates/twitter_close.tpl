<html>
<head>
    <script type="text/javascript">
        function CloseWindow() {
        	if (window.opener != null && !window.opener.closed) {
            var txtName = window.opener.document.getElementById("txtval");
            txtName.value = "1";
        }
            window.close();
            window.opener.location.reload();
        }
    </script>
</head>
<body  onload="CloseWindow()">
</body>
</html>