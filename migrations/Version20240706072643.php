<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240706072643 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat (id INT AUTO_INCREMENT NOT NULL, id_fournisseur_id INT NOT NULL, dateachat DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_26A984565A6AC879 (id_fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, id_ville_id INT NOT NULL, id_client_id INT NOT NULL, datecommande DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, etatcommande TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6EEAA67DF7E4ECA3 (id_ville_id), INDEX IDX_6EEAA67D99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_achat (id INT AUTO_INCREMENT NOT NULL, reference_id INT NOT NULL, id_achat_id INT NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitaire NUMERIC(10, 2) NOT NULL, INDEX IDX_5B594F0F1645DEA9 (reference_id), INDEX IDX_5B594F0FAE4E3D82 (id_achat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_commande (id INT AUTO_INCREMENT NOT NULL, reference_id INT NOT NULL, id_commande_id INT NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, INDEX IDX_98344FA61645DEA9 (reference_id), INDEX IDX_98344FA69AF8E3A3 (id_commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detail_vente (id INT AUTO_INCREMENT NOT NULL, reference_id INT NOT NULL, id_vente_id INT NOT NULL, quantite NUMERIC(10, 0) NOT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, INDEX IDX_F57AE1151645DEA9 (reference_id), INDEX IDX_F57AE1152D1CFB9F (id_vente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE emplacement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_user (event_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_92589AE271F7E88B (event_id), INDEX IDX_92589AE2A76ED395 (user_id), PRIMARY KEY(event_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone NUMERIC(10, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inventaire (id INT AUTO_INCREMENT NOT NULL, reference_id INT NOT NULL, update_at DATETIME NOT NULL, note VARCHAR(255) NOT NULL, stockinventaire NUMERIC(10, 0) NOT NULL, INDEX IDX_338920E01645DEA9 (reference_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, emplacement_id INT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, prixunitaire NUMERIC(10, 2) NOT NULL, dateexp DATETIME NOT NULL, qttemin NUMERIC(10, 0) NOT NULL, qttemax NUMERIC(10, 0) NOT NULL, capaciter VARCHAR(255) NOT NULL, unite VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, prixunitairevente NUMERIC(10, 2) NOT NULL, reference_produit VARCHAR(50) DEFAULT NULL, INDEX IDX_29A5EC279F34925F (id_categorie_id), INDEX IDX_29A5EC27C4598A51 (emplacement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, pseudo VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vente (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, datevente DATETIME NOT NULL, numfacture NUMERIC(10, 0) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', tva NUMERIC(10, 0) DEFAULT NULL, remise NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_888A2A4C99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A984565A6AC879 FOREIGN KEY (id_fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DF7E4ECA3 FOREIGN KEY (id_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0F1645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detail_achat ADD CONSTRAINT FK_5B594F0FAE4E3D82 FOREIGN KEY (id_achat_id) REFERENCES achat (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA61645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detail_commande ADD CONSTRAINT FK_98344FA69AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE1151645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE detail_vente ADD CONSTRAINT FK_F57AE1152D1CFB9F FOREIGN KEY (id_vente_id) REFERENCES vente (id)');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE271F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_user ADD CONSTRAINT FK_92589AE2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inventaire ADD CONSTRAINT FK_338920E01645DEA9 FOREIGN KEY (reference_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC279F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27C4598A51 FOREIGN KEY (emplacement_id) REFERENCES emplacement (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vente ADD CONSTRAINT FK_888A2A4C99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A984565A6AC879');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DF7E4ECA3');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D99DED506');
        $this->addSql('ALTER TABLE detail_achat DROP FOREIGN KEY FK_5B594F0F1645DEA9');
        $this->addSql('ALTER TABLE detail_achat DROP FOREIGN KEY FK_5B594F0FAE4E3D82');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA61645DEA9');
        $this->addSql('ALTER TABLE detail_commande DROP FOREIGN KEY FK_98344FA69AF8E3A3');
        $this->addSql('ALTER TABLE detail_vente DROP FOREIGN KEY FK_F57AE1151645DEA9');
        $this->addSql('ALTER TABLE detail_vente DROP FOREIGN KEY FK_F57AE1152D1CFB9F');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE271F7E88B');
        $this->addSql('ALTER TABLE event_user DROP FOREIGN KEY FK_92589AE2A76ED395');
        $this->addSql('ALTER TABLE inventaire DROP FOREIGN KEY FK_338920E01645DEA9');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC279F34925F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27C4598A51');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE vente DROP FOREIGN KEY FK_888A2A4C99DED506');
        $this->addSql('DROP TABLE achat');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detail_achat');
        $this->addSql('DROP TABLE detail_commande');
        $this->addSql('DROP TABLE detail_vente');
        $this->addSql('DROP TABLE emplacement');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_user');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE inventaire');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vente');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
