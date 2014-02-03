<html>
<style type="text/css">
/* tables */
table.tablesorter {
	font-family:arial;
	background-color: #CDCDCD;
	margin:10px 0pt 15px;
	font-size: 9pt;
	width: 50%;
	text-align: center;
}
table.tablesorter thead tr th, table.tablesorter tfoot tr th {
	background-color: #D9E6FE;
	border: 1px solid #FFF;
	font-size: 8pt;
	padding: 4px;
}
table.tablesorter thead tr .header {
	background-image: url(bg.gif);
	background-repeat: no-repeat;
	background-position: center right;
	cursor: pointer;
}
table.tablesorter tbody td {
	color: #3D3D3D;
	padding: 3px;
	background-color: #FFF;
	vertical-align: top;
	font color: #2F82FF;
	
}
table.tablesorter tbody tr.odd td {
	background-color:#F0F0F6;
}
table.tablesorter thead tr .headerSortUp {
	background-image: url(asc.gif);
}
table.tablesorter thead tr .headerSortDown {
	background-image: url(desc.gif);
}
table.tablesorter thead tr .headerSortDown, table.tablesorter thead tr .headerSortUp {
background-color: #8dbdd8;
}
</style>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="/jlocal/jquery-latest.js"></script> 
		<script type="text/javascript" src="tablesorter.js"></script> 
        <script type="text/javascript">
           $(document).ready(function() {		   
    // call the tablesorter plugin 
    $("table").tablesorter({  
	
    }); 
}); 
        </script>
<title>Agent Stats Report</title>
</head>
<?php

$phone=$_GET['phone'];
#$phone=7206204014;
$rbtype=$_GET['rbtype'];
#echo "Rapport phone $phone";
#echo "Rapport type $rbtype";


#if ($rbtype==nfl)	{echo "nfl";}
#if ($rbtype==mlb)	{echo "mlb";}
#if ($rbtype==colleges)	{echo "colleges";}
#if ($rbtype==collegefootball)	{echo "collegefootball";}
#if ($rbtype==colleges)	{echo "colleges";}
#if ($rbtype==collegefootball)	{echo "collegefootball";}

?>

<table width="578" class="tablesorter">
<thead>
<tr>
<th>Professional</th>
<th>College</th>
<th>Other</th>
</tr>
</thead>
	<tr>
		<td>
		<b><font face="Arial"><a href="mccrb.php?rbtype=nfl&phone=<?php echo $phone?>">
		<font color="#2B5CAB">NFL</font></a></b></td>

		<td>
		<b><font face="Arial"><a href="mccrb.php?rbtype=colleges&phone=<?php echo $phone?>">
		<font color="#2B5CAB">Colleges</font></a></font></b></td>

		<td>
		<b><font face="Arial"><a href="mccrb.php?rbtype=nascar&phone=<?php echo $phone?>"> 
		<font color="#2B5CAB">Nascar</font></a><font color="#2F82FF">
		</font></b></td>
	</tr>
	<tr>
		<td>
		<b><font face="Arial"><a href="mccrb.php?rbtype=mlb&phone=<?php echo $phone?>">
		<font color="#2B5CAB">MLB</font></a></b></td>

		<td>
		<font face="Arial"><b><a href="mccrb.php?rbtype=collegefootball&phone=<?php echo $phone?>">
		<font color="#2B5CAB">College Football</font></span></a></td>

		<td>
		<b><font face="Arial"><a href="mccrb.php?rbtype=military&phone=<?php echo $phone?>">
		<font color="#2B5CAB">Military Bases</font></b></a></td>
	</tr>
</table>
<?php
$link = $mysql = mysql_connect('192.168.100.59', 'cron', '1234', 'asteriskrcs') or die(mysql_error());
        mysql_select_db('asteriskrcs', $mysql);
	
if ($rbtype==nfl)	{$result = mysql_query("select distinct F.team,F.stadium,F.state,F.city,F.capacity from a_nfl F where F.state=(select distinct state from a_areacode where areacode=(select distinct LEFT($phone, CHAR_LENGTH($phone)-7)));");
while($row = mysql_fetch_array( $result )) {
echo "Team: ";
echo "<b><u>"; 
echo $row['team'];
echo "</b></u>";
echo " Stadium: ";
echo "<b><u>";
echo $row['stadium'];
echo "</b></u><br>";
};}
if ($rbtype==mlb)	{$result = mysql_query("select distinct B.team,B.stadium,B.state,B.city,B.capacity from a_mlb B where B.state=(select distinct state from a_areacode where areacode=(select distinct LEFT($phone, CHAR_LENGTH($phone)-7)));");
while($row = mysql_fetch_array( $result )) {
echo "Team: ";
echo "<b><u>"; 
echo $row['team'];
echo "</b></u>";
echo " Stadium: ";
echo "<b><u>";
echo $row['stadium'];
echo "</b></u><br>";
};}
if ($rbtype==colleges)	{$result = mysql_query("select institution,enrollment,city,state from a_colleges where State=(select distinct state from a_areacode where areacode=(select LEFT($phone, CHAR_LENGTH($phone)-7))) order by enrollment desc limit 0,5 ;");
while($row = mysql_fetch_array( $result )) {
echo "School: ";
echo "<b><u>"; 
echo $row['institution'];
echo "</font></b></u>";
echo " Enrollment: ";
echo "<b><u>";
echo $row['enrollment'];
echo "</b></u><br>";
};}
if ($rbtype==collegefootball)	{$result = mysql_query("select distinct N.state,N.school,N.location,N.conference,N.coach,S.stadium,S.city,S.state,S.college,S.conference from a_ncaa N join a_ncaa_stadium S on S.city=N.location where N.state like (select distinct state from a_areacode where areacode=(select distinct LEFT($phone, CHAR_LENGTH($phone)-7)));");
while($row = mysql_fetch_array( $result )) {
echo "School: ";
echo "<b><u>"; 
echo $row['school'];
echo "</b></u>";
echo " Stadium: ";
echo "<b><u>";
echo $row['stadium'];
echo "</b></u><br>";
};}
if ($rbtype==military)	{$result = mysql_query("select Name,State,Service from a_bases where State=(select distinct state from a_areacode where areacode=(select LEFT($phone, CHAR_LENGTH($phone)-7))) order by Service limit 0,5;");
while($row = mysql_fetch_array( $result )) {
echo "Base: ";
echo "<b><u>"; 
echo $row['Name'];
echo "</b></u>";
echo " Service: ";
echo "<b><u>";
echo $row['Service'];
echo "</b></u><br>";
};}
if ($rbtype==nascar)	{$result = mysql_query("select Track,Miles,Config,location,state,series,seats,races from a_nascar_tracks where State=(select distinct state from a_areacode where areacode=(select LEFT($phone, CHAR_LENGTH($phone)-7)));");
while($row = mysql_fetch_array( $result )) {
echo "Track: ";
echo "<b><u>"; 
echo $row['Track'];
echo "</b></u>";
echo " Races: ";
echo "<b><u>"; 
echo $row['races'];
echo "</b></u>";
echo " Location: ";
echo "<b><u>"; 
echo $row['location'];
echo "</b></u>";
echo " Series: ";
echo "<b><u>"; 
echo $row['series'];
echo "</b></u>";
echo " Miles: ";
echo "<b><u>";
echo $row['Miles'];
echo "</b></u><br>";
};}



mysql_close();


?>

</body>
</html>
