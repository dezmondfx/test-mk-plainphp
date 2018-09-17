<!DOCTYPE html>
<html lang="it-IT" prefix="og: http://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <title>MK Dealer</title>

    <link rel="stylesheet" href="/assets/multimodel.style.css" type="text/css" media="all">
</head>

<body>

<main role="main" class="multimodel step-first">
    <header class="multimodel__masthead">
        <div class="multimodel__header">
            <a href="/"><h1>MK Cars</h1></a>
        </div>
    </header>

<h3>Leads</h3>
<div class="grid">
    <?php foreach ($leads as $lead) { ?>
            <div class="grid__item u-12/12--medium u-6/12--large u-4/12--large-x">
                    <footer class="card__info">
                        <span class="make u-text--center"><?php echo $lead->firstname; echo " ".$lead->lastname;?></span>
                        <a href=" mailto: <?php echo $lead->email; ?> "><span class="make u-text--center"><?php echo $lead->email; ?></span></a>
                        <span class="make u-text--center"><?php echo $lead->phone; ?></span>
                        <span class="make u-text--center"><?php echo $lead->cap; ?></span>
                        <p class="u-text--center">Car ID: <?php echo $lead->carId; ?></p>
                    </footer>
            </div>
    <?php } ?>
</div>


</html>