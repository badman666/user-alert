<?php
/*
 * Plugin Name: User alert
 * Description: Возможность вывода сообщения пользователям сайта. Вывод: <?= do_shortcode('[user_alert]') ?> или [user_alert]
 * Plugin URI: https://github.com/badman666/user-alert
 * Version: 0.0.1
 * Author: BadMan666
*/

/**
 * Сохранение сообщения пользователю в панели администратора
 */
function UAAdminContent()
{
?>
    <div class="ua-wrap wrap">
        <div class="ua-content">
            <h1>User alert</h1>

            <?php if (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == true): ?>
                <div id="setting-error-settings_updated" class="notice notice-success settings-error is-dismissible">
                    <p><strong>Сообщение сохранено</strong></p>

                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">Скрыть это уведомление.</span>
                    </button>
                </div>
            <?php endif;?>

            <p>Возможность вывода сообщения пользователям сайта</p>
            <p>Вывод: <b><?= htmlspecialchars("<?= do_shortcode('[user_alert]') ?> или [user_alert]")?></b></p>

            <h2>Сообщение:</h2>
            <form method="post" action="options.php">
                <?php wp_nonce_field('update-options') ?>
                <?php wp_editor(get_option('user_alert'), 'user_alert'); ?>
                <br>
                <input type="hidden" name="action" value="update"/>
                <input type="hidden" name="page_options" value="user_alert"/>
                <input class="button button-primary" type="submit" name="update" value="Сохранить">
            </form>
        </div>
    </div>
<?php
}

/**
 * Пункт меню в панели администратора
 */
function UAAdminMenu()
{
    add_menu_page(
        'User alert',
        'User alert',
        8,
        basename(__FILE__),
        'UAAdminContent',
        'dashicons-info'
    );
}
add_action('admin_menu', 'UAAdminMenu');

/**
 * Получние сообщения для пользователя
 * @return string
 */
function UAGetContent()
{
    return get_option('user_alert');
}
add_shortcode('user_alert', 'UAGetContent');
