<?PHP

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Clothing;
use App\Entity\Note;
use App\Entity\Size;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer des utilisateurs
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setEmail("user$i@example.com")
                ->setPassword("password$i")
                ->setName("User $i")
                ->setRoles(['USER']);
            $manager->persist($user);
            $users[] = $user;
        }

        // Créer des tailles
        $sizes = [];
    foreach (['S', 'M', 'L', 'XL', '2XL', '32', '34', '36', '38', '40', '42', '44', '46', '48'] as $sizeLabel) {
        $size = new Size();
        $size->setLabel($sizeLabel);
        $manager->persist($size); // Ajoute l'objet dans Doctrine pour la sauvegarde
        $sizes[$sizeLabel] = $size; // Associe l'objet au label dans le tableau
    }

        // Créer des catégories
        $categories = [];
        foreach (['Jupes', 'Vestes / Manteaux', 'Sweats', 'T-shirts', 'Pantalons', 'Acessoires', 'Chemises', 'Robes'] as $categoryName) {
            $category = new Category();
            $category->setTitle($categoryName);
            $manager->persist($category);
            $categories[] = $category;
        }

        // Créer des notes
        $notes = [];
        foreach ($users as $user) {
            $note = new Note();
            $note->setAverageRating(mt_rand(1, 20))
                ->setUserRating(mt_rand(1, 20))
                ->setUser($user); // Associe un utilisateur à une note
            $manager->persist($note);
            $notes[] = $note;
        }

        // Créer des vêtements
        for ($i = 1; $i <= 10; $i++) {
            $clothing = new Clothing();
            $clothing->setTitle("Vêtement $i")
                ->setDescription("Description du vêtement $i")
                ->setPrice(mt_rand(10, 100))
                ->setReleasDate(new \DateTime())
                ->setImagePath('/images/vetement' . $i . '.png');

            // Associer une catégorie aléatoire
            $clothing->addCategory($categories[array_rand($categories)]);

            // Associer des tailles aléatoires
            foreach (['S', 'M', 'L', 'XL', '2XL', '32', '34', '36', '38', '40', '42', '44', '46', '48'] as $sizeKey) {
                $clothing->addSize($sizes[$sizeKey]);
            }

            // Associer une note aléatoire
            $clothing->setNotes($notes[array_rand($notes)]);

            $manager->persist($clothing);
        }

        $manager->flush();
    }
}
