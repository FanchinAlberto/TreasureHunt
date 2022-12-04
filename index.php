<?php 
session_start();

if (!isset($_SESSION['attempts']) || !isset($_SESSION['giardino'])){
    //prima richiesta iniziallizzo i tentativi
    $_SESSION['attempts'] = 3;
    $_SESSION['giardino'] = array_fill(0, 10, '🪴');
    //genero due posizioni non uguali
    $pos1 = random_int(0, 9);
    do {
        $pos2 = random_int(0,9);
    } while ($pos1 == $pos2);
    $_SESSION['status'] = 'TROVA I TESORI';
    $_SESSION['pos1'] = $pos1;
    $_SESSION['pos2'] = $pos2;
}
else if(isset($_POST['button'])){
    //bottone cliccato
    $index = $_POST['button'];

    if($index == 'play-again'){
        session_unset();
        session_destroy();
        header("Refresh:0");
    }

    if($_SESSION['status'] == 'TROVA I TESORI'){
        //diminuisco i tentativi se non ha già perso
        $_SESSION['attempts'] -= 1;
    }
    
    if($_SESSION['status'] != 'TROVA I TESORI'){

    }
    else if($_SESSION['attempts'] <= 0 ){
        $_SESSION['status'] = 'GAME OVER';
        $_SESSION['giardino'][$index] = '❌';       
    }
    else if($index == $_SESSION['pos1']){
        $_SESSION['giardino'][$index] = '✓';
        $_SESSION['pos1'] = -1;
    }
    else if($index == $_SESSION['pos2']){
        $_SESSION['giardino'][$index] = '✓';
        $_SESSION['pos2'] = -1;
    }
    else{
        $_SESSION['giardino'][$index] = '❌';
    }

    if ($_SESSION['pos2'] == $_SESSION['pos1']){
        $_SESSION['status'] = 'YOU WIN';
    }

}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="flex justify-center">
        <div class="items-center justify-center mt-60">
            <div class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2 ">
                ERRORI: <?php echo $_SESSION['attempts'];?>
        </div>
        <div class="items-center justify-center">
            <div class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2 ">
                <?php echo $_SESSION['status'];?>
        </div>
        </div>    
        <form action="" method="POST">
                <div class="flex items-center justify-center">
                    <button type="submit" name="button" value="0" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][0];?></button>        

                    <button type="submit" name="button" value="1" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2 ">
                    <?php echo $_SESSION['giardino'][1];?></button>
                    
                    <button type="submit" name="button" value="2" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][2];?></button>
                    
                    <button type="submit" name="button" value="3" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][3];?></button>
                    
                    <button type="submit" name="button" value="4" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][4];?></button>

                    <button type="submit" name="button" value="5" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][5];?></button>

                    <button type="submit" name="button" value="6" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][6];?></button>
                    
                    <button type="submit" name="button" value="7" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][7];?></button>
                    
                    <button type="submit" name="button" value="8" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][8];?></button>
                    
                    <button type="submit" name="button" value="9" class="text-7xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                    <?php echo $_SESSION['giardino'][9];?></button>
                </div>

                <button type="submit" name="button" value="play-again"  class="<?php
                    if($_SESSION['status'] == 'TROVA I TESORI'){
                        echo 'hidden"';
                    }
                ?> text-3xl bg-indigo-400 px-5 py-2.5 text-center mr-2 mb-2">
                PLAY AGAIN</button>
            </form>
        
    </body>

</html>