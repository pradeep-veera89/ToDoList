<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826145655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `lead` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(10) DEFAULT NULL, last_name VARCHAR(10) DEFAULT NULL, email VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lead_campaign (lead_id INT NOT NULL, campaign_id INT NOT NULL, INDEX IDX_B54690DE55458D (lead_id), INDEX IDX_B54690DEF639F774 (campaign_id), PRIMARY KEY(lead_id, campaign_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lead_campaign ADD CONSTRAINT FK_B54690DE55458D FOREIGN KEY (lead_id) REFERENCES `lead` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lead_campaign ADD CONSTRAINT FK_B54690DEF639F774 FOREIGN KEY (campaign_id) REFERENCES campaign (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lead_campaign DROP FOREIGN KEY FK_B54690DE55458D');
        $this->addSql('ALTER TABLE lead_campaign DROP FOREIGN KEY FK_B54690DEF639F774');
        $this->addSql('DROP TABLE `lead`');
        $this->addSql('DROP TABLE lead_campaign');
    }
}
