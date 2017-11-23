<?php


namespace Kugaudo\PhpEnum\Samples;


use Kugaudo\PhpEnum\Samples\Polymorphic\GenderPolymorphicBase;
use Kugaudo\PhpEnum\Samples\Polymorphic\GenderPolymorphicBaseExt;
use Kugaudo\PhpEnum\Samples\Polymorphic\GenderPolymorphicImpl;
use Kugaudo\PhpEnum\Samples\Polymorphic\GenderPolymorphicInterface;
use Kugaudo\PhpEnum\Samples\Simple\GenderMinimal;
use Kugaudo\PhpEnum\Samples\Simple\GenderWithHelpers;
use Kugaudo\PhpEnum\Samples\Simple\GenderWithPrimaryKey;

class UsageSample
{
    public function minimalSample()
    {
        // creating pointers
        $male = GenderMinimal::MALE();
        $female = GenderMinimal::FEMALE();

        // passing as method argument
        self::writeln(self::greeting($male));
        self::writeln(self::greeting($female));

        // comparing pointers
        self::writeln($male === $female ? 'true' : 'false');
        self::writeln($female === GenderMinimal::FEMALE() ? 'true' : 'false');

        // iterating over the values with type hinting
        foreach (GenderMinimal::values() as $value) {
            self::writeln($value->getTitle());
        }

        return $this;
    }

    public function primaryKeySample()
    {
        // imitating reading from storage
        function dummyFetch(): GenderWithPrimaryKey {
            // dummy calculation of referenced id
            $ref = (1 + 1) / 2;
            return GenderWithPrimaryKey::find($ref);
        }
        $gender = dummyFetch();
        self::writeln(sprintf('Fetched gender [title=%s]', $gender->getTitle()));

        // imitating persisting in storage
        function dummyPersist(GenderWithPrimaryKey $gender) {
            return $gender->getPk();
        }
        $persistedRef = dummyPersist(GenderWithPrimaryKey::MALE());
        self::writeln(sprintf('Persisted reference [id=%d]', $persistedRef));

        return $this;
    }

    public function helperMethodsSample()
    {
        // dynamic pointers
        $male = GenderWithHelpers::findByTitle('male');
        $female = GenderWithHelpers::findByShortCode('f');

        // calling helper methods
        if ($male->isMale() && $female->isFemale()) {
            self::writeln(implode(', ', [$male, $female]));
        }

        return $this;
    }

    public function polymorphicSample()
    {
        // the pointer of extended class is not strictly equal to base class pointer
        if (GenderPolymorphicBase::MALE() === GenderPolymorphicBaseExt::MALE() ||
            GenderPolymorphicBase::FEMALE() === GenderPolymorphicBaseExt::FEMALE()) {
            throw new \LogicException('Polymorphism went wrong');
        }
        // but they do hold equal data
        if (GenderPolymorphicBase::MALE()->getTitle() !== GenderPolymorphicBaseExt::MALE()->getTitle() ||
            GenderPolymorphicBase::FEMALE()->getTitle() !== GenderPolymorphicBaseExt::FEMALE()->getTitle()) {
            throw new \LogicException('Polymorphism went wrong');
        }
        self::writeln('Polymorphic pointers are brilliant');

        // calling base methods from child class
        foreach (GenderPolymorphicBaseExt::getHumans() as $human) {
            self::writeln($human->getTitle());
        }

        // passing as method argument
        self::writeln(self::polymorphicGreeting(GenderPolymorphicImpl::ALIEN()));

        return $this;
    }

    /**
     * @param GenderMinimal $gender
     * @return string
     */
    private static function greeting(GenderMinimal $gender)
    {
        // using in switch cases
        switch ($gender) {
            case GenderMinimal::MALE():
                return 'Mr.';
            case GenderMinimal::FEMALE():
                return 'Ms./Mrs.';
        }
        throw new \LogicException('Unhandled Gender constant');
    }

    /**
     * @param GenderPolymorphicInterface $gender
     * @return string
     */
    private static function polymorphicGreeting(GenderPolymorphicInterface $gender)
    {
        if ($gender->getTitle() === 'MALE' || $gender->getTitle() === 'FEMALE') {
            return 'Hello!';
        } else {
            return 'Welcome to Earth!';
        }
    }

    /**
     * @param string $message
     */
    private static function writeln(string $message)
    {
        echo $message . PHP_EOL;
    }
}