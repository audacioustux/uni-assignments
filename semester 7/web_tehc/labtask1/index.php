<?php

require "Validation.php";
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Object Creation for Validation
    $validation = new Validation($_POST);
    $errors = $validation->validateForm();

    if (empty($errors)) {
        header("Location: confirmation.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabTask -- registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <ul>
                <li class="is-active"><a href="#" aria-current="page">1 Donation</a></li>
                <li><a href="#">2 Confirmation</a></li>
                <li><a href="#">Thank You!</a></li>
            </ul>
        </nav>
        <form method="POST" action="/index.php">
            <h1 class="is-size-3 mb-3 has-text-info">Donor Information</h1>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">First Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_first-name" value="<?php if (isset($_POST['donor_first-name'])) echo $_POST['donor_first-name']; ?>" required>
                            <p class="help is-danger"><?php if (isset($errors['donor_first-name'])) echo $errors['donor_first-name']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Last Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_last-name" value="<?php if (isset($_POST['donor_last-name'])) echo $_POST['donor_last-name']; ?>" required>
                            <p class="help is-danger"><?php if (isset($errors['donor_last-name'])) echo $errors['donor_last-name']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Company</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_company" value="<?php if (isset($_POST['donor_company'])) echo $_POST['donor_company']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Address 1</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_addr1" value="<?php if (isset($_POST['donor_addr1'])) echo $_POST['donor_addr1']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Address 2</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_addr2" value="<?php if (isset($_POST['donor_addr2'])) echo $_POST['donor_addr2']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">City</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_city" value="<?php if (isset($_POST['donor_city'])) echo $_POST['donor_city']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">State</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="donor_state" value="<?php if (isset($_POST['donor_state'])) echo $_POST['donor_state']; ?>" required>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Zip Code</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="must be a number" name="donor_zip" pattern="\d+" value="<?php if (isset($_POST['donor_zip'])) echo $_POST['donor_zip']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Country</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="donor_country" value="<?php if (isset($_POST['donor_country'])) echo $_POST['donor_country']; ?>" required>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Phone</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_phone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Fax</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="donor_fax">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Email</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="email" placeholder="must be valid email address" name="donor_email" value="<?php if (isset($_POST['donor_email'])) echo $_POST['donor_email']; ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Donation Amount</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                None
                            </label>
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                $50
                            </label>
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                $75
                            </label>
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                $100
                            </label>
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                $250
                            </label>
                            <label class="radio">
                                <input type="radio" name="donor_donation-amount">
                                other
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                </div>
                <div class="field-body">
                    <div class="field is-horizontal is-narrow">
                        <div class="field-label is-small">
                            <label class="label nowrap">Other Amount</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control">
                                    <input class="input is-small" type="text" placeholder="" name="donor_donation-amount">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="field is-horizontal">
                <div class="field-label">
                    <label class="label">Recurring Donation</label>
                </div>
                <div class="field-body">
                    <label class="checkbox">
                        <input type="checkbox" name="donor_is-recurr">
                        I am interested in giving on a regular basis.
                    </label>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                </div>
                <div class="field-body">
                    <div class="field is-small">
                        <p>Monthly Credit Card $ <input size=4 name="donor_recurr-amount"> For <input size=2 name="donor_recurr-month"> Months</p>
                    </div>
                </div>
            </div>

            <h1 class="is-size-3 mb-3 has-text-info">Honorarium and Memorial Donation Information</h1>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">I would like to make donation</label>
                </div>
                <div class="field-body">
                    <div class="field-body">
                        <div class="control">
                            <label class="radio is-block">
                                <input type="radio" name="h-and-m_as">
                                To Honor
                            </label>
                            <label class="radio is-block ml-0">
                                <input type="radio" name="h-and-m_as">
                                In memory of
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="h-and-m_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Acknowledge Donation to</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="h-and-m_ack-to">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Address</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="h-and-m_addr">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">City</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="h-and-m_city">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">State</label>
                </div>
                <div class="field-body">
                    <div class="field is-narrow">
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="h-and-m_state">
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Zip</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="must be a number" name="h-and-m_zip" pattern="\d+">
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="is-size-3 mb-3 has-text-info">Additional Information</h3>
            <p class="is-size-5 mb-5">Please enter your name, company or organization as you would like it to appear in our publications: </p>

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Name</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input class="input" type="text" placeholder="" name="add-inf_name">
                        </div>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="checkbox is-block">
                    <input type="checkbox" name="add-inf_is-anon">
                    I would like my gift to remain anonymous.
                </label>
                <label class="checkbox is-block">
                    <input type="checkbox" name="add-inf_will-mail">
                    My employer offers a matching gift program. I will mail matching gift form.
                </label>
                <label class="checkbox is-block">
                    <input type="checkbox" name="add-inf_dont_mail">
                    Please save the cost of acknowledging this gift by not mailing a thank you letter.
                </label>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Comments</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea" placeholder="Please type any question or feedback here" name="add-inf_comments"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">How may we contact you</label>
                </div>
                <div class="field-body">
                    <div class="field-body">
                        <div class="control">
                            <label class="checkbox is-block">
                                <input type="checkbox" name="add-inf_contact-by-mail">
                                E-mail
                            </label>
                            <label class="checkbox is-block ml-0">
                                <input type="checkbox" name="add-inf_contact-by-pmail">
                                Postal Mail
                            </label>
                            <label class="checkbox is-block ml-0">
                                <input type="checkbox" name="add-inf_contact-by-tele">
                                Telephone
                            </label>
                            <label class="checkbox is-block ml-0">
                                <input type="checkbox" name="add-inf_contact-by-fax">
                                Fax
                            </label>
                        </div>
                    </div>
                    <div class="control">
                        <p>I would like to recieve newsletters and information about special events by:</p>

                        <label class="checkbox is-block ml-0">
                            <input type="checkbox" name="add-inf_receive-by-mail">
                            E-mail
                        </label>
                        <label class="checkbox is-block ml-0">
                            <input type="checkbox" name="add-inf_receive-by-pmail">
                            Postal Mail
                        </label>
                    </div>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-body">
                    <label class="checkbox">
                        <input type="checkbox" name="is_inf_volunteer">
                        I would like information about volunteering with the lorem ipsum -_- .
                    </label>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label">
                    <!-- Left empty for spacing -->
                </div>
                <div class="field-body">
                    <div class="field is-grouped">
                        <div class="control">
                            <button class="button">
                                Reset
                            </button>
                        </div>
                        <div class="control">
                            <button class="button is-primary">
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>