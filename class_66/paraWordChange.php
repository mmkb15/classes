<?php


$para = "The United States is withdrawing 5,000 troops from NATO ally Germany, the Pentagon announced on Friday, as a rift over the Iran war widens between President Donald Trump and Europe.
Trump had threatened a drawdown in forces earlier this week after sparring with German Chancellor Friedrich Merz, who said on Monday the Iranians were humiliating the US in talks to end the two-month-old war and that he did not see what exit strategy Washington was pursuing.
A senior Pentagon official, speaking on condition of anonymity, said recent German rhetoric had been inappropriate and unhelpful.
Discover more
World news summaries
Political analysis reports
Automotive industry news
The president is rightly reacting to these counterproductive remarks, the official said.
The Pentagon said the withdrawal was expected to be completed over the next six to 12 months. Germany is home to some 35,000 active-duty US military personnel, more than anywhere else in Europe.
The official said the drawdown would bring US troop levels in Europe back to roughly pre-2022 levels, before Russia's invasion of Ukraine triggered a buildup by then-President Joe Biden.
The official also cast the decision in terms of the Trump administration's push for Europe to become the main security provider on the continent. But it is nonetheless another potent reminder of Trump's willingness to respond to perceived disloyalty by allies.
Reuters exclusively reported last week an internal Pentagon email that outlined options to punish NATO allies that Washington believes failed to support US operations in the war with Iran, including suspending Spain from NATO and reviewing the US position on Britain's claim to the Falkland Islands.
Discover more
Lifestyle content platform
Health news portal
Mobile news app
Clashes With Europeans
It is unclear if more withdrawals from Europe will follow. On Thursday, Trump said probably when asked whether he would consider pulling US troops out of Italy and Spain.
Last month, he threatened to impose a full US trade embargo on Spain, where the Socialist leadership said it would not allow its bases or airspace to be used to attack Iran. The United States has two important military bases in Spain: Naval Station Rota and Morón Air ⁠Base.
Trump has also clashed with Italian Prime Minister Giorgia Meloni over the Iran war and Trump's criticism of Pope Leo. The US president said in April that Meloni, once a strong Trump supporter, lacked courage and had let Washington down.
Trump has chastised NATO allies, too, for not sending their navies to help open the Strait of Hormuz. The waterway, a chokepoint for global oil shipments, has remained virtually shut during the Iran conflict, causing market turmoil and unprecedented disruption in energy supplies.
The president has been very clear about his frustrations about our allies' rhetoric and failure to provide support for US operations that benefit them, the senior Pentagon official said.
";


echo $para;
echo "<br><br>";

$words = explode(" ", $para);

foreach($words as $key => $word){
    $words[$key] = $word;
}

$newPara = implode(" ", $words);

echo $newPara;




?>