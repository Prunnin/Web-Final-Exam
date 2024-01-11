<?php

class Teacher
{
    private $name;
    private $avatar;
    private $description;
    private $specialized;
    private $degree;
    private $updated;
    private $created;

    // Constructor to initialize properties
    public function __construct($name, $avatar, $description, $specialized, $degree)
    {
        $this->name = $name;
        $this->avatar = $avatar;
        $this->description = $description;
        $this->specialized = $specialized;
        $this->degree = $degree;

        // Set default values for updated and created
        $this->updated = date('Y-m-d H:i:s');
        $this->created = date('Y-m-d H:i:s');
    }

    public function set_avatar($avatar){
        $this->avatar = $avatar;
    }

    // Getter methods
    public function create_teacher(PDO $db)
    {
        $query = "INSERT INTO teachers (name, avatar, description, specialized, degree, updated, created)
                  VALUES (:name, :avatar, :description, :specialized, :degree, :updated, :created)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':avatar', $this->avatar);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':specialized', $this->specialized);
        $stmt->bindParam(':degree', $this->degree);
        $stmt->bindParam(':updated', $this->updated);
        $stmt->bindParam(':created', $this->created);

        $stmt->execute();

        return true;
    }

    // Function to update an existing teacher record
    public function update_teacher($teacherId, PDO $db)
    {
        $query = "UPDATE teachers
                  SET name = :name, avatar = :avatar, description = :description,
                      specialized = :specialized, degree = :degree, updated = :updated
                  WHERE id = :id";
        $this->updated = date('Y-m-d H:i:s');

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $teacherId);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':avatar', $this->avatar);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':specialized', $this->specialized);
        $stmt->bindParam(':degree', $this->degree);
        $stmt->bindParam(':updated', $this->updated);

        $stmt->execute();

        return;
    }

    public function get_id(PDO $db)
    {
        $query = "SELECT id FROM teachers
                  WHERE name = :name AND avatar = :avatar AND description = :description AND
                      specialized = :specialized AND degree = :degree AND created = :created AND updated = :updated";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':avatar', $this->avatar);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':specialized', $this->specialized);
        $stmt->bindParam(':degree', $this->degree);
        $stmt->bindParam(':updated', $this->updated);
        $stmt->bindParam(':created', $this->created);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function get_teacher_by_id($id, PDO $db)
    {
        $query = "SELECT id, name, avatar, specialized, description, degree   FROM teachers WHERE id = :id";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetchAll()[0];
    }


    public function printInfo()
    {
        echo "Teacher Information:\n <br>";
        echo "Name: {$this->name}\n <br>";
        echo "Avatar: {$this->avatar}\n<br>";
        echo "Description: {$this->description}\n<br>";
        echo "Specialized: {$this->specialized}\n<br>";
        echo "Degree: {$this->degree}\n<br>";
        echo "Updated: {$this->updated}\n<br>";
        echo "Created: {$this->created}\n<br>";
    }

    // Additional methods can be added as needed
}

// // Create a Teacher instance
// $teacher = new Teacher("John Doe", "avatar.jpg", "Math teacher", "Mathematics", "Ph.D.");

// // Print the teacher's information
// $teacher->printInfo();
