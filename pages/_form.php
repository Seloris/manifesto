<div class="form">
    <?php
    $signed = isset($_GET['signed']) ?  $_GET['signed'] : 0;
    $url = "/$lang/signataires.php";

    if ($signed)
        echo $tradThanks;
    else
        printf($tradJoinSignataires, $total);
    ?>

    <p class="grey1 form__intro"><?= $tradYouCanSign ?></p>

    <form id="sign-form" action="/add-signataire.php" method="post">
        <input id="destination" type="hidden" name="destination" value="<?php echo $url ?>" />

        <div class="form-group__field">
            <!-- <label for="lastName">nom ou pseudonyme *</label> -->
            <input type="text" id="lastName" required maxlength="50" <?php echo $signed ? 'readonly' : '' ?> name="lastName" />
            <label for="lastName"><?= $tradFormLastName ?></label>

        </div>
        <div class="form-group__field">
            <input maxlength="50" id="firstName" <?php echo $signed ? 'readonly' : '' ?> type="text" name="firstName" />
            <label for="firstName"><?= $tradFormFirstName ?></label>
        </div>
        <div class="form-group__field">
            <input maxlength="50" id="email" required <?php echo $signed ? 'readonly' : '' ?> type="email" name="email" />
            <label for="email"><?= $tradFormEmail ?></label>
        </div>
        <div class="form-group__field">
            <select id="country" required <?php echo $signed ? 'disabled="true"' : '' ?> name="country">
                <option value="null"></option>
                <?php
                foreach ($countriesAll as $country) {
                    printf('<option value="%s">%s</option>', $country["id"], $country["country_name"]);
                }
                ?>
            </select>
            <label for="country"><?= $tradFormCountry ?></label>
        </div>
        <div class="form-group__field">
            <input maxlength="100" id="activity" <?php echo $signed ? 'readonly' : '' ?> type="text" name="activity" />
            <label for="activity"><?= $tradFormActivity ?></label>
        </div>

        <div class="checkbox grey1">
            <input required class="chk" <?php echo $signed ? 'onclick="return false;"' : '' ?> id="accept" name="accept" type="checkbox" />
            <label for="accept"><?= $tradFormAccept ?></label>
        </div>

        <button <?php echo $signed ? 'disabled' : '' ?> class="submit-btn red1 bold" type="submit"><span class="underline"><?= $tradISign ?></span></button>
        <button id="fill" type="button"> fill</button>


    </form>

    <?php include '_footer.php'; ?>
</div>