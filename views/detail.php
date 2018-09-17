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
    <div id="multimodel__wrapper" class="multimodel__wrapper">
        <section class="multimodel__slider">
            <div class="grid">
                <div class="grid__item u-12/12--medium u-6/12--large u-4/12--large-x">
                    <article class="card">
                        <figure class="card__picture">
                            <div class="card__image">
                                <img src="<?php echo $car->attrs->img ?>">
                            </div>
                        </figure>
                        <footer class="card__info">
                            <span class="make u-text--center"><?php echo $car->attrs->make ?></span>
                            <span class="model u-text--center"><?php echo $car->attrs->model ?></span>
                        </footer>
                    </article>
                </div>
            </div>
        </section>

        <section class="multimodel__content">
            <div class="dk-forms">
                <form method="post" action="/newLead">
                    <div class="landing-form-fields">
                        <span class="field field__name">
                            <label for="name" class="gui-label">Nome</label>
                            <input type="text" id="name"
                                   name="name"
                                   required="required" class="gui-input">
                        </span>
                        <span class="field field__surname">
                            <label for="surname" class="gui-label">Cognome</label>
                            <input type="text" id="surname"
                                   name="surname"
                                   required="required" class="gui-input">
                        </span>
                        <span class="field field__email">
                            <label for="email" class="gui-label">Email</label>
                            <input type="email" id="email"
                                   name="email"
                                   required="required"
                                   class="gui-input">
                        </span>
                        <div class="input-group-tel-zipcode">
                            <span class="field field__telephone">
                                <label for="phone" class="gui-label">Telefono</label>
                                <input
                                        type="tel" id="phone" placeholder="Telefono"
                                        name="phone"
                                        inputmode="numeric"
                                        required="required" class="gui-input">
                            </span>

                            <span class="field field__cap">
                                <label for="zip" class="gui-label">CAP</label>
                                <input type="tel" id="zip"
                                       name="zip"
                                       required="required" class="gui-input">
                            </span>
                            <input type="text" id="carId"
                                   name="carId"
                                   required="required" value="<?php echo $car->attrs->carId ?>" hidden>
                        </div>
                    </div>
                    <div class="option-group field field__privacy">
                        <input type="checkbox"
                               name="privacy"
                               id="privacy"
                               value="Y"
                               required="required"
                               class="gui-checkbox">

                        <label for="privacy" class="option gui-label">
                            <span class="gui-label-text">
                                Ho letto e accetto <a href="#" target="_blank"> la privacy policy</a>
                            </span>
                        </label>
                    </div>
                    <footer class="multimodel__leadform-cta">
                        <button type="submit" class="leadform__submit cta-primary cta--wide has-transform-active">
                            Request quote
                        </button>
                    </footer>
                </form>
            </div>


        </section>
    </div>

</main>

<h3>Similar Cars</h3>
<div class="grid">
    <?php foreach ($similarCars as $car) { ?>
        <a href="/detail/<?php echo $car->attrs->carId; ?>">
            <div class="grid__item u-12/12--medium u-6/12--large u-4/12--large-x">
                <article class="card">
                    <figure class="card__picture">
                        <div class="card__image">
                            <img src="<?php echo $car->attrs->img; ?>">
                        </div>
                    </figure>
                    <footer class="card__info">
                        <span class="make u-text--center"><?php echo $car->attrs->make; ?></span>
                        <span class="model u-text--center"><?php echo $car->attrs->model; ?></span>
                        <p class="u-text--center">Car ID: <?php echo $car->attrs->carId; ?></p>
                    </footer>
                </article>
            </div>
        </a>
    <?php } ?>
</div>


</html>