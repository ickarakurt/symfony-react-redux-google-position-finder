<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190512144957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rank DROP FOREIGN KEY FK_8879E8E5166D1F9C');
        $this->addSql('DROP INDEX IDX_8879E8E5166D1F9C ON rank');
        $this->addSql('ALTER TABLE rank CHANGE project_id keyword_id INT NOT NULL');
        $this->addSql('ALTER TABLE rank ADD CONSTRAINT FK_8879E8E5115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id)');
        $this->addSql('CREATE INDEX IDX_8879E8E5115D4552 ON rank (keyword_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE rank DROP FOREIGN KEY FK_8879E8E5115D4552');
        $this->addSql('DROP INDEX IDX_8879E8E5115D4552 ON rank');
        $this->addSql('ALTER TABLE rank CHANGE keyword_id project_id INT NOT NULL');
        $this->addSql('ALTER TABLE rank ADD CONSTRAINT FK_8879E8E5166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8879E8E5166D1F9C ON rank (project_id)');
    }
}
