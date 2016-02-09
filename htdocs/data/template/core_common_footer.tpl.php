<?php if(!defined('IN_DZZ')) exit('Access Denied'); updatesession();?><?php if(!$_G['setting']['bbclosed']) { if(!isset($_G['cookie']['sendmail'])) { ?>
<script src="misc.php?mod=sendmail&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } ?>
    <?php if(!isset($_G['cookie']['sendwx'])) { ?>
        <script src="misc.php?mod=sendwx&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
    <?php } } if($_G['uid'] && $_G['adminid'] == 1 && !isset($_G['cookie']['checkupgrade'])) { ?>
<script src="misc.php?mod=upgrade&action=checkupgrade&rand=<?php echo $_G['timestamp'];?>" type="text/javascript"></script>
<?php } ?>
</body>
</html>
