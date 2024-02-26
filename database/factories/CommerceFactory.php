<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommerceFactory extends Factory
{

    public function definition()
    {
        $lat = $this->faker->latitude(10.504550, 10.478286);
        $lon = $this->faker->longitude(-66.935595, -66.784592);
        $telephone = $this->faker->numerify('##########');
        $whatsapp = $this->faker->numerify('##########');
        $category_id = $this->faker->numberBetween(1, 7);


        $textos = [
            '',
            'El restaurante está bellamente decorado en un estilo tradicional con una gran selección de clásicos. La comida es una mezcla de clásicos italianos y toques modernos. El menú se centra en ingredientes frescos y recién producidos para garantizar que la calidad se pueda maximizar. Exploraremos platos creativos como el sésamo y el queso de cabra con panceta de cerdo crujiente, ajo asado y piñones, o el filete de salmón con salsa de eneldo. , naranja y menta.',
            'Lo servimos fresco, a nuestros clientes y socios. No ponemos excusas, ni pretendemos que no es bueno. Somos el café de la gente, por la gente y para la gente. Somos el café que a la gente le encanta beber. Somos el café que a la gente le encanta comprar, comer y beber. Somos el café que a la gente le encanta comprar. Somos el café que a la gente le encanta beber. Somos el café que a la gente le encanta comprar y beber. Somos el mejor amigo de la gente del café.',
            'Somos una cafetería y tostadora con sede en la increíblemente hermosa ciudad de Litten, a solo minutos de la ciudad de Bremen. Estamos muy contentos de presentarles nuestra última oferta: el Litten Coffeeshop. Una selección de los mejores cafés de todo el mundo. Nos complace anunciar que esta nueva empresa será la primera colaboración oficial entre Coffeeshop Company y Litten Roaster. También nos complace anunciar que el nuevo tostador de café será fabricado en la ciudad de Litten por la misma empresa.',
            'Nuestro equipo está altamente capacitado, dedicado y con gran experiencia en el campo de la medicina deportiva, rehabilitación deportiva, medicina deportiva, evaluaciones ortopédicas y nutrición deportiva. El equipo está entrenado y certificado por un médico destacado en medicina deportiva y especialista en nutrición deportiva y el uso de medicina deportiva y evaluaciones ortopédicas. El equipo también está capacitado y certificado por un médico ortopédico experimentado y especialista en el uso de evaluaciones ortopédicas.',
            'laboratorio bioanalisis sangre examenes medicos y problidad en aquella a pax de ver la prado, para que lo será no quieres diferentes comunicacionas. Hic esta vez leer alguno mismodores sino más información con el mundo durante los medias vultures nacionalistas por esperanza sobre su regalo del país o curiosamente trabajo así - ¿Qué bien las usted solucionados?³ You may also like:',
            'Eso es lo que hace que mi práctica sea tan poderosa y liberadora; Tengo la suerte de haber sido elegido por mis alumnos, profesores y clientes para crear un espacio y un entorno donde puedan reunirse para descubrir su propia belleza interior, sanar de adentro hacia afuera, ser abiertos y auténticos consigo mismos y con los demás. . Mi salón de clases es principalmente una exploración personal de autodescubrimiento y el viaje del amor propio. He tomado cientos de clases a lo largo de los años en un esfuerzo por crear un espacio para fomentar el crecimiento y enseñar a las personas cómo hacer lo mismo.',
            'educacion , en la guerra de los que no se vece nada aún alguno entrar por lo manera. El otro cualquier días pueden te recogría del derecho es una trabajo (miserió fácil) sobre conseguir su asistencia estarán "determinador" y ha siduvo me acuerdo siempre comembro desde 15 marzo el 1¡hustores para obtener este 11 hombres partidas todos os vientos perdisc',
            'cursos de equisémiento a la gente del juego, y en este perdido está su propio especial. La lucha no podía hay se implejir una hacienda desarrollado para informancias comunarios que nada el jugador pueden ser descargao por otro obtener lo largero (estuvo) con clases entre los sieteores cusiánicanoes son pedros al punto más altra! Tostados partidas donde recomendable así quien',
        ];


        return [
            'name' => $this->faker->company,
            'user_name' => $this->faker->firstName,
            'user_lastname' => $this->faker->lastName,
            'user_email' => $this->faker->safeEmail,             

            'telephone_code' => 'VE',
            'telephone_number' => $telephone,
            'telephone_number_code' => '+58',
            'telephone' => $telephone,

            'info' => $textos[$category_id],
            'lat' => $lat,
            'lon' => $lon,
            'logo' => '/logos/logo' . $this->faker->numberBetween(1, 10) . '.jpg',

            'whatsapp_code' => 'VE',
            'whatsapp_number' => $whatsapp,
            'whatsapp_number_code' => '+58',
            'whatsapp' => $whatsapp,

            'facebook' => $this->faker->url,
            'web' => $this->faker->url,
            'instagram' => $this->faker->url,
            'payment' => 'Efectivo',
            'category_id' => $category_id,
            'expiration_date' => date("Y-m-d", strtotime(date('Y-m-d') . "+ 1 year")),
            'paid' => 'Y',
            'destacar' => 'Y',
            'excerpt' => $this->faker->paragraph(4)
        ];
    }
}
