<style>
    /* ==== Таблица ============= */
    .table_cell {
        display: inline-block;
        margin-top: 10px;
    }
    
    .left_cell {
        width:29%;
        text-align: right;
    }
    .right_cell {
        width:69%;
    }

    /* ==== Форма ============= */

    .headform .right_cell input {
        width: 40%;
    }
    .headform .right_cell textarea {
        width: 90%;
    }
    
    @media(max-width:600px) {
        /* ==== Таблица ============= */
        .left_cell {
            width:100%;
            text-align: left;
        }
        .headform  .right_cell {
            width:100%;

        /* ==== Форма ============= */

        }
        .headform  .right_cell input, .right_cell textarea {
            width: 99%;
        }
    }
</style>

<div class="headform">
    <form method="post" action="<?php echo WB_URL; ?>/send.php" enctype="application/x-www-form-urlencoded" accept-charset="UTF-8">
    <p>&nbsp;</p>
    <div class='table' align="left" style="width:90%;">

                <div class='table_cell left_cell'><h7>Ваше имя:</h7></div>
                <div class='table_cell right_cell'><input style="color: #000; border: 1px solid #183c32;" type="text" name="fio" required="required" size="35" /></div>
                
                <br>

                <div class='table_cell left_cell'><h7>Ваш телефон:</h7></div>
                <div class='table_cell right_cell'><input style="color: #000; border: 1px solid #183c32;" id="phone" type="tel" name="phone" required="required" pattern="+([0-9]{1}) ([0-9]{3}) [0-9]{3}-[0-9]{2}-[0-9]{2}" /></div>
                
                <br>

                <div class='table_row'>
                    <div class='table_cell left_cell'  style='vertical-align:middle;'><h7>Ваш вопрос:</h7></div>
                    <div class='table_cell right_cell' style='vertical-align:middle;'><textarea style="color: #000; border: 1px solid #183c32;" rows="5" name="zayavka"></textarea></div>
                </div>
                
                <br>

                <div class='table_cell left_cell'><h7>Капча:</h7></div>
                <div class='table_cell right_cell'><?php call_captcha('image'); echo ' = '; call_captcha('input'); ?></div>
                
		<br>
		
		<div class='table_cell left_cell' style="color:#000; width:auto;"><input type='checkbox' name='i_agree' required="required" style='cursor:pointer;'></div>
		<div class='table_cell right_cell' style="width:auto;"><h6>Согласен (на) с условиями <a onclick="W.open_by_api('get_agreement', {add_sheet:true})" style='cursor:pointer;'>Пользовательского соглашения</a></h6></div>

    </div>
    <table align="center" width="90%" border="0" cellpadding="1" cellspacing="1">
        <tbody>
            <tr>
                <td width="100%" style="text-align: center;"><input type="submit" name="ok" class="btn-head" value="Отправить" /></td>
            </tr>
        </tbody>
    </table>
    </form>
</div>
