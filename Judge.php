<?php
/**
 *
 * Check if this word is allowed in Hostinger network
 *
 * @package Judge
 */
class Judge
{
    private $database;

    public function __construct()
    {
        $this->database = json_decode(file_get_contents(__DIR__ . '/data.json'), 1);
    }

    /**
     * Check if given word is allowed
     *
     * @param string $word
     * @return boolean
     * @throws Exception
     */
    public function isValid($word)
    {
        // check regexp
        foreach ($this->database['reserved_app_names']['regexp'] as $record) {
            if (preg_match("/$record/i", $word)) return false;
        }
        // check by phishing words
        foreach ($this->database['reserved_app_names']['phishing_words'] as $record) {
            if (stripos($word, $record) !== false) return false;
        }
        // check by brands
        foreach ($this->database['reserved_app_names']['brands'] as $record) {
            if (stripos($word, $record) !== false) return false;
        }
        return true;
    }
}

