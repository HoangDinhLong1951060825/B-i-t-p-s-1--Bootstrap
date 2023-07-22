<?php
interface IBook {
    public function getTitle();
    public function setTitle($title);
    public function getAuthor();
    public function setAuthor($author);
    public function getPublisher();
    public function setPublisher($publisher);
    public function getYear();
    public function setYear($year);
    public function getISBN();
    public function setISBN($isbn);
    public function getChapters();
    public function setChapters($chapters);
}
class Book implements IBook {
    private $title;
    private $author;
    private $publisher;
    private $year;
    private $isbn;
    private $chapters;

    public function __construct($title, $author, $publisher, $year, $isbn, $chapters) {
        $this->title = $title;
        $this->author = $author;
        $this->publisher = $publisher;
        $this->year = $year;
        $this->isbn = $isbn;
        $this->chapters = $chapters;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getPublisher() {
        return $this->publisher;
    }

    public function setPublisher($publisher) {
        $this->publisher = $publisher;
    }

    public function getYear() {
        return $this->year;
    }

    public function setYear($year) {
        $this->year = $year;
    }

    public function getISBN() {
        return $this->isbn;
    }

    public function setISBN($isbn) {
        $this->isbn = $isbn;
    }

    public function getChapters() {
        return $this->chapters;
    }

    public function setChapters($chapters) {
        $this->chapters = $chapters;
    }
}
class BookList {
    private $books = array();

    public function addBook($book) {
        array_push($this->books, $book);
    }

    public function getBooks() {
        return $this->books;
    }

    public function sortBooksByAuthor() {
        usort($this->books, function($a, $b) {
            return strcmp($a->getAuthor(), $b->getAuthor());
        });
    }

    public function sortBooksByTitle() {
        usort($this->books, function($a, $b) {
            return strcmp($a->getTitle(), $b->getTitle());
        });
    }

    public function sortBooksByYear() {
        usort($this->books, function($a, $b) {
            return $a->getYear() - $b->getYear();
        });
    }
}
?>
<?php
// Thêm sách mới vào một mảng chứa những cuốn sách
$bookList = new BookList();
$bookList->addBook(new Book('Sách 1', 'Tác giả 1', 'NXB 1', 2021, '123-456-789', array('Chương 1', 'Chương 2')));
$bookList->addBook(new Book('Sách 2', 'Tác giả 2', 'NXB 2', 2022, '987-654-321', array('Chương 1', 'Chương 2', 'Chương 3')));
//$bookListChúng ta còn thiếu phần mã HTML/CSS/JS để hiển thị giao diện ứng dụng Web. Dưới đây là một ví dụ về cách xây dựng giao diện sử dụng HTML/CSS/JS để thực hiện các yêu cầu:
?>
html
<!DOCTYPE html>
<html>
<head>
    <title>Quản lý danh sách sách</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Quản lý danh sách sách</h1>

    <h2>Danh sách sách:</h2>

    <table>
        <tr>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Nhà xuất bản</th>
            <th>Năm xuất bản</th>
            <th>Số hiệu ISBN</th>
            <th>Danh mục các chương sách</th>
        </tr>
        <?php foreach ($bookList->getBooks() as $book): ?>
            <tr>
                <td><?php echo $book->getTitle(); ?></td>
                <td><?php echo $book->getAuthor(); ?></td>
                <td><?php echo $book->getPublisher(); ?></td>
                <td><?php echo $book->getYear(); ?></td>
                <td><?php echo $book->getISBN(); ?></td>
                <td><?php echo implode(', ', $book->getChapters()); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Chức năng sắp xếp danh sách:</h2>

    <form method="post">
        <label for="sortBy">Sắp xếp theo:</label>
        <select name="sortBy" id="sortBy">
            <option value="author">Tác giả</option>
            <option value="title">Tên sách</option>
            <option value="year">Năm xuất bản</option>
        </select>
        <button type="submit">Sắp xếp</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sortBy = $_POST['sortBy'];
        switch ($sortBy) {
            case 'author':
                $bookList->sortBooksByAuthor();
                break;
            case 'title':
                $bookList->sortBooksByTitle();
                break;
            case 'year':
                $bookList->sortBooksByYear();
                break;
        }
    }
    ?>

    <p><a href="add_book.php">Thêm sách mới</a></p>
</body>
</html>