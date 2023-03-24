<script src="/blockadblock/blockadblock.js"></script>
<script>
    // Function called if AdBlock is not detected
    function adBlockNotDetected() {
        // alert("No Ad Block present");
    }
    // Function called if AdBlock is detected
    function adBlockDetected() {
        alert("Ad Block is present");
        $("body").empty()
        $("body").html("<center><h1>Please disable adblock first!!!</h1></center>")
    }

    if (typeof blockAdBlock === "undefined") {
        adBlockDetected();
    } else {
        blockAdBlock.onDetected(adBlockDetected);
        blockAdBlock.onNotDetected(adBlockNotDetected);
    }
</script>
