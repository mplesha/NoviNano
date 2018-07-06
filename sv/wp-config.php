<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'sv');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'g%s(Pw0HkS!ric>q<=,`sZ|(:AVS%Wm+$)hfaD$UQN(vo?<ST_)rEtm/%]4(nAYQ');
define('SECURE_AUTH_KEY',  'uJ-s`7>1n@PjE}uk}J2MJr.xZ&n>Ix1ph/r@;5$Znld6!H.o*=PMmHXu{g7t{0|~');
define('LOGGED_IN_KEY',    '6*=5v-Th.bZDl~|n06Rc:-|_cY9eqJC0,4bh8ARy *[yQ;xw`z?3A3=iM6JWH)6c');
define('NONCE_KEY',        '-/[-fr[II{2lq%X9oglQZ(!Pj3p-fS8f5g**m-dvFnz=Y6u^dBL2;}&cn4(h2B-]');
define('AUTH_SALT',        '=r`f*1SXFvsN9v>$nwD^Ymr!(?C?)A&=32 [- kj6+?b%od`/BoMp47yc=BY(M7U');
define('SECURE_AUTH_SALT', ',Dxdu::>;x8yVR #nL.FqEN,auM5r,+nGW@GHPndv>-x4&r;/?br9a$Plxo4GwB<');
define('LOGGED_IN_SALT',   '-7U(c{2g6-|y?d?i[$rMlfg3|1S0CNqj&mN{=}>E78-(}Z/%903|7FL18r<CqK<[');
define('NONCE_SALT',       '1rP+U$Ji!$Sos]uNR)j]]J]!;&/_ uhkg1P+b,]of[BO`]x|L4~sACh3L}=(790m');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
