<?php


namespace Kugaudo\PhpEnum\Samples;


class UsageSample
{
    public function sampleOps()
    {
        // direct pointer
        $male = Gender::MALE();
        // dynamic pointer
        $female = Gender::getByTitle('female');

        // calling regular methods
        if ($male->isMale() && $female->isFemale()) {
            $this->writeln(implode(', ', [$male, $female]));
        }

        // comparing pointers
        $this->writeln($male === $female ? 'true' : 'false');
        $this->writeln($female === Gender::FEMALE() ? 'true' : 'false');

        // iterating over the values with type hinting
        foreach (Gender::values() as $value) {
            $this->writeln($value->getTitle());
        }

        // using in switch cases
        switch ($male) {
            case Gender::MALE():
                $this->writeln('Mr.');
                break;
            case Gender::FEMALE():
                $this->writeln('Ms./Mrs.');
                break;
        }
    }

    private function writeln(string $message)
    {
        echo $message . PHP_EOL;
    }
}