<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180118204503 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('CREATE TABLE evenement_has_projet (evenement_id INT NOT NULL, projet_id INT NOT NULL, INDEX IDX_8D4D377CFD02F13 (evenement_id), INDEX IDX_8D4D377CC18272 (projet_id), PRIMARY KEY(evenement_id, projet_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE evenement_has_projet ADD CONSTRAINT FK_8D4D377CFD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE evenement_has_projet ADD CONSTRAINT FK_8D4D377CC18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE evenement_has_projet');
        $this->addSql('ALTER TABLE evenement ADD projet_id INT DEFAULT NULL, ADD fiction_id INT DEFAULT NULL, ADD global TINYINT(1) NOT NULL, ADD annee INT DEFAULT NULL, ADD mois INT DEFAULT NULL, ADD jour INT DEFAULT NULL, ADD date_creation DATETIME DEFAULT NULL, ADD last_update DATETIME DEFAULT NULL, CHANGE contenu contenu LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE titre nom VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
