<!DOCTYPE html>
<html>
<head>
    <title>Page</title>
</head>
<body>
    <?php
    class Page {
        private $page;
        private $title;
        private $year;
        private $copyright;

        function __construct($title, $year, $copyright) {
            $this->title = $title;
            $this->year = $year;
            $this->copyright = $copyright;
        }

        private function addHeader() {
            $this->page = file_get_contents("Header.php");
        }

        private function addFooter() {
            $this->page .= file_get_contents("Footer.php");
            $this->page .= "<span>".$this->title.$this->year.$this->copyright."</span></footer>";
        }

        public function addContent() {
            $this->page .= file_get_contents("Content.php");
        }

        public function get() {
            $this->addHeader();
            $this->addContent();
            $this->addFooter();
            return $this->page;
        }
    }
    ?>
</body>
</html>