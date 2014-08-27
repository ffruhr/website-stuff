<p>
Derzeit sind unsere Freifunker bereits in den nachfolgenden Städten aktiv:
<?php
$comms_url  = "https://raw.githubusercontent.com/ffruhr/website-stuff/master/communities/communities.json";
$comms_json = file_get_contents($comms_url);
$comms_arr  = json_decode($comms_json,TRUE);

asort($comms_arr);

echo "<table>\n";
echo "<tr><td style=\"font-weight: bold; width: 230px;\">Stadt/Community</td>\n";
echo "    <td style=\"font-weight: bold; width: 50px;\">Karte</td>\n";
echo "    <td style=\"font-weight: bold;\">Ansprechpartner</td>\n";
echo "</tr>\n";

foreach($comms_arr as $community_arr) {                                                                                                               // run through communities
  $community = new stdClass();
  $community = json_decode(json_encode($community_arr), FALSE);
  if($community->name == "Template") continue;                                                                                                        // ignore the template

  echo "<tr>\n";
  if($community->url) {                                                                                                                               // if url is present
    echo "  <td valign=\"top\" style=\"padding-left: 10px;\"><a href=\"$community->url\" target=\"_new\">&bull; $community->name</a>";                // link community name
  } else {
    echo "  <td valign=\"top\" style=\"padding-left: 10px;\">&bull; $community->name";                                                                // else print plaintext
  }
  if($community->prefix) echo " ($community->prefix)";                                                                                                // print prefix if present
  echo "</td>\n";

  if($community->map) {                                                                                                                               // if map url is present
    echo "  <td valign=\"top\" align=\"center\"><a href=\"$community->map\" target=\"_new\"><img src=\"http://freifunk-ruhrgebiet.de/wp-content/uploads/2014/08/location-map.png\" width=\"15\"/></a></td>\n"; // print map icon
  } else {
    echo "  <td valign=\"top\">&nbsp;</td>\n";
  }

  if($community->contacts) {                                                                                                                          // if contacts present
    echo "<td>\n";
    foreach($community->contacts as $contact) {                                                                                                       // run through contacts
      echo "<a href=\"mailto:$contact->mail\">";                                                                                                      // link name with mail
      if($contact->firstname) echo "$contact->firstname ";                                                                                            // if present print firstname
      if($contact->nickname)  echo "'$contact->nickname' ";                                                                                           // if present print nickname
      if($contact->lastname)  echo "$contact->lastname";                                                                                              // if present print lastname
      echo "</a><br />\n";
    }
    echo "</td>\n";
  } else {
    echo "<td>&nbsp;</td>\n";
  }
  echo "</tr>\n";
  }
echo "</table>\n";
?>
</p>
