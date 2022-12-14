<?php
ini_set('display_errors', true);
require_once 'src/SqlGenerator.php';
$dbFile = 'db.db';
if (is_writable(file_exists($dbFile) ? $dbFile : '.') === false) {
    throw new RuntimeException('Write permission required to create and use example database file "' . $dbFile . '"');
}

function display($file)
{
    $text = file_get_contents($file);
    $text = highlight_string($text, true);
    // remove php tag
    $text = preg_replace("|\\&lt;\\?php\\<br /\\>|", "", $text, 1);
    $text = preg_replace("|\\&nbsp;|", " ", $text);
    echo '<pre>' . $text . '</pre>';
}

function execFile($file)
{
    global $sg, $data, $dbh;
    ob_start();
    require $file;
    $result = ob_get_clean();
    if (!empty($result)) {
        ?>
        <pre><code><?php echo $result; ?></code></pre>
        <?php
    }
}

function displayAndExec($file)
{
    ?>
    <div class="columns">
        <div>
            <?php display($file); ?>
        </div>
        <div>
            <?php execFile($file); ?>
        </div>
    </div>
    <?php
}

function phpArrayToHtml($data)
{
?>
<table>
    <thead>
    <tr><?php
        foreach ($data[0] as $field => $value) {
            echo '<th>' . $field . '</th>';
        } ?>
    </tr>
    </thead>
    <tbody><?php
    foreach ($data as $row) {
        echo '<tr>';
        foreach ($row as $field => $value) {
            echo '<td>' . $value . '</td>';
        }
        echo '</tr>';
    } ?>
    </tbody>
</table>
<?php
}

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SqlGenerator</title>
    <link rel="stylesheet" href="examples/style.css">
</head>
<body>
<header>
    <h1>SqlGenerator</h1>
</header>
<main>
    <article>
        <header><h2>Connection / Initialization</h2></header>
        <p>When creating a SqlGenerator instance, you will need an opened connection to your DSN using PDO:</p>
        <?php displayAndExec('examples/01-new.php'); ?>
    </article>

    <article>
        <header><h2>Create a database</h2></header>
        <p>Since we will need tables and data to use SqlGenerator, let's create some by executing an SQL script
            file using <code>SqlGenerator::executeFile()</code>.
            We will need write access to the directory where you installed SqlGenerator.</p>
        <?php displayAndExec('examples/02-create-db.php'); ?>
        <p>Let's now consider the following DB schema:</p>
        <img src="db.drawio.png">
    </article>

    <article>
        <header><h2 id="select-base"><code>->select()</code>: basic usage</h2></header>
        <div class="columns">
            <div>
                <p>Here is a simple <code>SELECT *</code> query.</p>
                <?php $file = 'examples/03-select-base.php';
                display($file); ?>
            </div>
            <div>
                <p>Data (array of <code class="inline important">StdClass</code> by default):</p>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
            </div>
        </div>
    </article>

    <article>
        <header><h2 id="select-advanced"><code>->select()</code>: advanced usage</h2></header>
        <div class="columns">
            <div>
                <p>SqlGenerator defaults to returning <code>StdClass</code> instances but it can pass
                    configuration to PDO so as to fetch associative arrays (<code>PDO::FETCH_ASSOC</code>)
                    or classes (<code>PDO::FETCH_CLASS</code>) instead.</p>
                <?php $file = 'examples/04-select-advanced.php';
                display($file); ?>
            </div>
            <div>
                <p>Data (array of <code class="inline important">Series</code> instances):</p>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
                <p>Query string:</p>
                <pre><code><?php echo $sg->toString(); ?></code></pre>
            </div>
        </div>
    </article>

    <article>
        <header><h2><code>->insert()</code></h2></header>
        <div class="columns">
            <div>
                <?php $file = 'examples/05-insert.php';
                display($file); ?>
            </div>
            <div>
                <p><em>Tintin</em> added:</p>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
            </div>
        </div>
    </article>

    <article>
        <header><h2><code>->update()</code></h2></header>
        <div class="columns">
            <div>
                <?php $file = 'examples/06-update.php';
                display($file); ?>
            </div>
            <div>
                <p><em>Thorgal</em> updated as <em>Thorgal Aegirsson</em>:</p>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
            </div>
        </div>
    </article>

    <article>
        <header><h2><code>->delete()</code></h2></header>
        <div class="columns">
            <div>
                <?php $file = 'examples/07-delete.php';
                display($file); ?>
            </div>
            <div>
                <p>Success status and resulting data:</p>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
            </div>
        </div>
    </article>

    <article>
        <header><h2>Linking method calls</h2></header>
        <div class="columns">
            <div>
                <p>Every method returns the <code>SqlGenerator</code> query object (<code>$this</code>) so that you can
                    link methods in a single instruction:</p>
                <?php $file = 'examples/08-link.php';
                display($file); ?>
            </div>
            <div>
                <?php
                execFile($file);
                phpArrayToHtml($data);
                ?>
            </div>
        </div>
    </article>

    <article>
        <header><h2>Transactions</h2></header>
        <p>You can use transactions and also check if you are in one:</p>
        <?php displayAndExec('examples/09-transaction.php'); ?>
    </article>

    <article>
        <header><h2>Other useful methods</h2></header>
        <div class="columns">

            <div>
                <p>Example of use for the remaining available methods:</p>
                <?php $file = 'examples/10-other.php';
                display($file); ?>
            </div>
            <div>
                <?php execFile($file); ?>

                <table>
                    <tbody><?php
                    foreach ($data as $key => $value) { ?>
                        <tr>
                            <th><?php echo $key; ?></th>
                            <td><pre class="simple"><?php
                                    var_export($value);
                                    ?></pre>
                            </td>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </article>

</main>
</body>
</html>