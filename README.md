# php-enum
Tiny Java-styled enumeration support for PHP based on traits.  
Supports identifier-driven enums and class extensions (see [/samples](samples)).

The minimalistic sample of enumeration class looks like:
```php
final class GenderMinimal
{
    use BasicEnum;

    /**
     * @return self[]
     */
    protected static function init()
    {
        return [
            'MALE' => new self('Male'),
            'FEMALE' => new self('Female'),
        ];
    }

    /** @var string */
    private $title;

    /**
     * Private constructor avoids external creation of the instances.
     * @param string $title Title
     */
    private function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return self
     */
    public static function MALE()
    {
        return self::values()['MALE'];
    }

    /**
     * @return self
     */
    public static function FEMALE()
    {
        return self::values()['FEMALE'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}
```

Some ways of usage:
```php
class UsageSample
{
    public function minimalisticSample()
    {
        // creating pointers
        $male = GenderMinimal::MALE();
        $female = GenderMinimal::FEMALE();

        // passing as method argument
        self::assert(self::greeting($male) === 'Mr.');
        self::assert(self::greeting($female) === 'Ms./Mrs.');

        // comparing pointers
        self::assert($male !== $female);
        self::assert($female === GenderMinimal::FEMALE());

        // iterating over the values with type hinting
        foreach (GenderMinimal::values() as $value) {
            self::assert(in_array($value->getTitle(), ['Male', 'Female']));
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
        self::assert($gender->getTitle() === 'Male');

        // imitating persisting in storage
        function dummyPersist(GenderWithPrimaryKey $gender) {
            return $gender->getPk();
        }
        $persistedRef = dummyPersist(GenderWithPrimaryKey::MALE());
        self::assert($persistedRef === 1);

        return $this;
    }

    public function helperMethodsSample()
    {
        // dynamic pointers
        $male = GenderWithHelpers::findByTitle('male');
        $female = GenderWithHelpers::findByShortCode('f');

        // calling helper methods
        self::assert($male->isMale());
        self::assert($female->isFemale());

        return $this;
    }

    public function polymorphicSample()
    {
        // the pointer of extended class is not strictly equal to base class pointer
        self::assert(GenderPolymorphicBase::MALE() !== GenderPolymorphicBaseExt::MALE());
        self::assert(GenderPolymorphicBase::FEMALE() !== GenderPolymorphicBaseExt::FEMALE());

        /// but they do hold equal data
        self::assert(GenderPolymorphicBase::MALE()->getTitle() === GenderPolymorphicBaseExt::MALE()->getTitle());
        self::assert(GenderPolymorphicBase::FEMALE()->getTitle() === GenderPolymorphicBaseExt::FEMALE()->getTitle());

        // calling base methods from child class
        foreach (GenderPolymorphicBaseExt::getHumans() as $human) {
            self::assert(in_array($human->getTitle(), ['Male', 'Female']));
        }

        // passing as method argument
        self::assert(self::polymorphicGreeting(GenderPolymorphicImpl::ALIEN()) === 'Welcome to Earth!');

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
        if (in_array($gender->getTitle(), ['Male', 'Female'])) {
            return 'Hello!';
        } else {
            return 'Welcome to Earth!';
        }
    }

    /**
     * @param bool $assertion
     */
    private static function assert(bool $assertion)
    {
        if (!$assertion) {
            throw new \LogicException('Something went wrong');
        }
    }
}
```
