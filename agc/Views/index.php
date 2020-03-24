<div class="wrap">
    <h1>AGC Manager</h1>
    <form method="post" action="?page=agcmanager_index&change=true" novalidate="novalidate">
        <table class="form-table">
            <tbody>
            <tr>
                <th scope="row"><label for="token">Token</label></th>
                <td><input readonly name="token" type="text" id="token" value="<?php echo $token ?>"
                           class="regular-text" onclick="this.setSelectionRange(0, this.value.length)"></td>
            </tr>
            </tbody>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                                 value="Change Token"></p>
    </form>
</div>