<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
</head>
<body>
    <div width="100%" >
        <div style="background: #fff; max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <div style="background: #fff; font-family: 'Courier New', Courier, monospace;text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <img src="https://grupoahvsolucionesinformaticas.es/assets/images/auth-text.png" alt="" width="250px">
            </div>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td style="font-family: 'Courier New', Courier, monospace;">
                                <?php echo $info;?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <a style="font-family: 'Courier New', Courier, monospace;cursor:pointer; color: #fff; background-color: #038edc;border-color: #038edc; display: inline-block; font-weight: 400; line-height: 1.5; text-align: center; text-decoration: none; vertical-align: middle; user-select: none; border: 1px solid transparent; padding: 0.375rem 0.75rem; font-size: 1rem;border-radius: 0.25rem;" href="<?php echo $link;?>" ><?php echo $btnText;?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="background: #fff; font-family: 'Courier New', Courier, monospace;text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <?php echo $footerMsg;?>
            </div>
        </div>
    </div>
</body>
</html>