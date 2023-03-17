<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?include('foot.php');?>

<?
$IP = $_SERVER['REMOTE_ADDR'];
$IP_long = ip2long($IP);
if ('dev' != APPLICATION_ENV) {
    
    $needCounters = true;
    $ranges = [
            ['66.249.64.0', '66.249.95.255']
        ];
    foreach ($ranges as $range) {
        if (ip2long($range[0]) < $IP_long && ip2long($range[1]) > $IP_long) {
            $needCounters = false;
        }
    }
    
    if ($needCounters) {
        include('counters_head.php');
        include('counters_body.php');
    }
    
}

?>
</body>
</html>
