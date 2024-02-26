<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use DB;

class CategorySeeder extends Seeder
{
    public function run(){

        $category = new Category();
        $category->name = 'Restaurantes';
        $category->image_url = '/categories/restaurantes.png';
        $category->position = 1;        
        $category->save();

        $category = new Category();
        $category->name = 'Bodegones';
        $category->image_url = '/categories/bodegones.png';
        $category->position = 1;        
        $category->save();

        DB::unprepared("INSERT INTO `categories` (`id`, `created_at`, `updated_at`, `name`, `image_url`, `position`) VALUES
        (3, '2022-06-10 08:00:02', '2022-06-10 08:00:02', 'Cafeterías', '/categories/cafeteria.png', 1),
        (4, '2022-06-10 08:00:03', '2022-06-10 08:00:03', 'Salud', '/categories/salud.png', 2),
        (5, '2022-06-10 08:00:04', '2022-06-10 08:00:04', 'Laboratorios', '/categories/laboratorios.png', 2),
        (6, '2022-06-10 08:00:05', '2022-06-10 08:00:05', 'Farmacías', '/categories/farmacia.png', 2),
        (7, '2022-06-10 08:00:06', '2022-06-10 08:00:06', 'Educación', '/categories/educacion.png', 3),
        (8, '2022-06-10 08:00:07', '2022-06-10 08:00:07', 'Cursos', '/categories/cursos.png', 3),
        (9, '2022-06-10 08:00:08', '2022-06-10 08:00:08', 'Automóviles', '/categories/automoviles.png', 4),
        (10, '2022-06-10 08:00:09', '2022-06-10 08:00:09', 'Caucheras', '/categories/cauchos.png', 4),
        (11, '2022-06-10 08:00:10', '2022-06-10 08:00:10', 'Repuestos', '/categories/repuestos.png', 4),
        (12, '2022-06-10 08:00:11', '2022-06-10 08:00:11', 'Ferreterías', '/categories/ferreteria.png', 5),
        (13, '2022-06-10 08:00:12', '2022-06-10 08:00:12', 'Tecnología', '/categories/tecnologia.png', 5),
        (14, '2022-06-10 08:00:13', '2022-06-10 08:00:13', 'Discotecas', '/categories/discoteca.png', 6),
        (15, '2022-06-10 08:00:14', '2022-06-10 08:00:14', 'Bares', '/categories/bares.png', 6),
        (16, '2022-06-10 08:00:15', '2022-06-10 08:00:15', 'Licorerías', '/categories/licorerias.png', 6),
        (17, '2022-06-10 08:00:16', '2022-06-10 08:00:16', 'Barberías', '/categories/barberia.png', 7),
        (18, '2022-06-10 08:00:17', '2022-06-10 08:00:17', 'Estética', '/categories/belleza.png', 7),
        (19, '2022-06-10 08:00:18', '2022-06-10 08:00:18', 'Refrigeración', '/categories/refrigeracion.png', 5),
        (20, '2022-06-10 08:00:19', '2022-06-10 08:00:19', 'Odontología', '/categories/odontologo.png', 2),
        (21, '2022-06-10 08:00:20', '2022-06-10 08:00:20', 'Cine', '/categories/cines.png', 9),
        (22, '2022-06-10 08:00:21', '2022-06-10 08:00:21', 'Agricultura', '/categories/agro.png', 1),
        (23, '2022-06-10 08:00:22', '2022-06-10 08:00:22', 'Papelería', '/categories/papeleria.png', 8),
        (24, '2022-06-10 08:00:23', '2022-06-10 08:00:23', 'Bancos', '/categories/banco.png', 12),
        (25, '2022-06-10 08:00:24', '2022-06-10 08:00:24', 'Estado', '/categories/gobierno.png', 12),
        (26, '2022-06-10 08:00:25', '2022-06-10 08:00:25', 'Joyas', '/categories/joyas.png', 9),
        (27, '2022-06-10 08:00:26', '2022-06-10 08:00:26', 'Deportes', '/categories/deportes.png', 10),
        (28, '2022-06-10 08:00:27', '2022-06-10 08:00:27', 'Taxis', '/categories/taxis.png', 11),
        (29, '2022-06-10 08:00:28', '2022-06-10 08:00:28', 'Seguridad', '/categories/seguridad.png', 12),
        (30, '2022-06-10 08:00:29', '2022-06-10 08:00:29', 'Gimnasios', '/categories/gimnasio.png', 10),
        (31, '2022-06-10 08:00:30', '2022-06-10 08:00:30', 'Viajes', '/categories/viajes.png', 1),
        (32, '2022-06-10 08:00:31', '2022-06-10 08:00:31', 'Seguros', '/categories/seguros.png', 2),
        (33, '2022-06-10 08:00:32', '2022-06-10 08:00:32', '+18', '/categories/adultos.png', 14),
        (34, '2022-06-10 08:00:33', '2022-06-10 08:00:33', 'Mercados', '/categories/supermercados.png', 1),
        (35, '2022-06-10 08:00:34', '2022-06-10 08:00:34', 'Arreglos', '/categories/arreglos.png', 13),
        (36, '2022-06-10 08:00:35', '2022-06-10 08:00:35', 'Hoteles', '/categories/hoteles.png', 1),
        (37, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Esoterismo', '/categories/astrologia.png', 15),
        (38, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Electrodomésticos', '/categories/electrodomesticos.png\r\n', 5),
        (39, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Redes', '/categories/redes.png\r\n', 5),
        (40, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Iluminación', '/categories/iluminacion.png\r\n', 5),
        (41, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Repostería', '/categories/reposteria.png\r\n', 1),
        (42, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Panaderia', '/categories/panaderia.png\r\n', 1),
        (43, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Bebés', '/categories/bebes.png', 9),
        (44, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Librerías', '/categories/libreria.png', 8),
        (45, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Ropa', '/categories/tacon.png', 9),
        (46, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Biblioteca', '/categories/biblioteca.png', 8),
        (47, '2022-06-10 08:00:36', '2022-06-10 08:00:36', 'Otros', NULL, 2000)");
    }
}
