<?php

namespace Database\Seeders;

use App\Models\stylistQuestionCatogaries;
use App\Models\stylistQuestions;
use App\Models\stylistQuestionsAnswers;
use App\Models\stylistQuestionSectionName;
use App\models\stylistTagCatogaries;
use App\models\StylistTags;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //last fix id = fix_rand_id_145 , fix_rand_id_146, fix_rand_id_147, fix_rand_id_148, fix_rand_id_149,
        // fix_rand_id_150, fix_rand_id_151, fix_rand_id_152,
        $questions_category_id = array();
        $questions_category = array();
        $questions_category[1] = 'LET’S GET PERSONAL';
        $questions_category[2] = 'Tell us about your appearance';
        $questions_category[3] = 'WOMEN’S QUESTIONNAIRE';
        $questions_category[4] = 'MEN’S QUESTIONNAIRE';
        foreach ($questions_category as $key => $category_name) {
            $data = array('name' => $category_name);
            $qt_category = stylistQuestionCatogaries::create($data);
            $questions_category_id[$key] = $qt_category->id;
        }

        $question_name_section = array();
        $question_name_section[1] = 'SIZING & BODYSHAPE';
        $question_name_section[2] = 'PERSONAL STYLE';
        $question_name_section[3] = 'PREFERRED STYLES';
        $question_name_section[4] = 'COLOUR & FABRIC';
        $question_name_section[5] = 'BUDGET';

        foreach ($question_name_section as $key => $section) {
            $section_data = array('name' => $section);
            $qt_section = stylistQuestionSectionName::create($section_data);
            $question_name_section[$key] = $qt_section->id;
        }

        $tag_category = array();
        $tag_category[1] = 'Skin tone';
        $tag_category[2] = 'Hair';
        $tag_category[3] = 'Eyes';
        $tag_category[4] = 'Height';
        $tag_category[5] = 'Tops';
        $tag_category[6] = 'Bottoms';
        $tag_category[7] = 'Shoes';

        foreach ($tag_category as $key => $tag_category_info) {

            $tags_category_has = stylistTagCatogaries::where('name', $tag_category_info)->first();
            if ($tags_category_has) {
                $tag_category[$key] = $tags_category_has->id;
            } else {
                $tags_category_data = array('name' => $tag_category_info);
                $tagcategory__obj = stylistTagCatogaries::create($tags_category_data);
                $tag_category[$key] = $tagcategory__obj->id;
            }

        }

        $tags = array();
        $tags[1] = 'Male';
        $tags[2] = 'Female';
        $tags[3] = 'Other';
        $tags[4] = 'Long Arms';
        $tags[5] = 'Doesn’t need a reference';
        $tags[6] = 'Short Arms';
        $tags[7] = 'Large bust';
        $tags[8] = 'Doesn’t need reference';
        $tags[9] = 'Small bust';
        $tags[10] = 'Narrow shoulder';
        $tags[11] = 'Proportionate shoulder';
        $tags[12] = 'Broad shoulder';
        $tags[13] = 'Long torso';
        $tags[14] = 'Proportionate torso';
        $tags[15] = 'Short torso';
        $tags[16] = 'Exaggerate waist curve';
        $tags[17] = 'Slight waist curve';
        $tags[18] = 'Straight waist';
        $tags[19] = 'Exaggerated thigh curve';
        $tags[20] = 'Slight thigh curve';
        $tags[21] = 'Straight thigh';
        $tags[22] = 'Long legs';
        $tags[23] = 'Short legs';
        $tags[24] = 'Black';
        $tags[25] = 'Brown';
        $tags[26] = 'Olive';
        $tags[27] = 'Tanned';
        $tags[28] = 'White Freckles';
        $tags[29] = 'White No Freckles';
        $tags[30] = 'Prefer not to say';
        $tags[31] = 'Dark Brown';
        $tags[32] = 'Light Brown';
        $tags[33] = 'Blonde';
        $tags[34] = 'Auburn';
        $tags[35] = 'Ginger';
        $tags[36] = 'Grey';
        $tags[37] = 'White';
        $tags[38] = 'No hair';
        $tags[39] = 'Green';
        $tags[40] = 'Hazel';
        $tags[41] = 'Blue';
        $tags[42] = 'XXS / 4';
        $tags[43] = 'XS / 6';
        $tags[44] = 'S / 8';
        $tags[45] = 'M / 10';
        $tags[46] = 'L /12';
        $tags[47] = 'XL / 14';
        $tags[48] = 'XXL / 16';
        $tags[49] = 'XXXL / 18';
        $tags[50] = '3XL / 20';
        $tags[51] = '4XL / 22';
        $tags[52] = '35';
        $tags[53] = '35.5';
        $tags[54] = '36';
        $tags[55] = '36.5';
        $tags[56] = '37';
        $tags[57] = '37.5';
        $tags[58] = '38';
        $tags[59] = '38.5';
        $tags[60] = '39';
        $tags[61] = '39.5';
        $tags[62] = '40';
        $tags[63] = '40.5';
        $tags[64] = '41';
        $tags[65] = '41.5';
        $tags[66] = '42';
        $tags[67] = 'XS / 36';
        $tags[68] = 'S / 38';
        $tags[69] = 'M / 40 ';
        $tags[70] = 'L / 42 ';
        $tags[71] = 'XL / 44 ';
        $tags[72] = 'XXL / 46 ';
        $tags[73] = '3XL / 48 ';
        $tags[74] = '4XL / 50 ';
        $tags[75] = '28 / XS ';
        $tags[76] = '30 / S ';
        $tags[77] = '32 / M ';
        $tags[78] = '34 / L ';
        $tags[79] = '36 / XL ';
        $tags[80] = '38 / XXL ';
        $tags[81] = '40 / 3XL ';
        $tags[82] = '42 / 4XL ';
        $tags[83] = '6 / 40 ';
        $tags[84] = '7 / 41 ';
        $tags[85] = '8 / 42 ';
        $tags[86] = '9 / 43 ';
        $tags[87] = '10 / 44 ';
        $tags[88] = '11 / 45 ';
        $tags[89] = '12 / 46 ';
        $tags[90] = '13+ ';
        $tags[91] = 'Thick neck';
        $tags[92] = 'Broad chest';
        $tags[93] = 'Narrow chest';
        $tags[94] = 'Slim/Straight shoulder';
        $tags[95] = 'Athletic shoulder';
        $tags[96] = 'Round belly / fit too tight';
        $tags[97] = 'Slim / fit too loose';
        $tags[98] = 'Long torso and/or round belly';
        $tags[99] = 'Wide bicep';
        $tags[100] = 'Full thigh';
        $tags[101] = 'Slim thigh';
        $tags[102] = 'Full calf';
        $tags[103] = 'Slim calf';

        foreach ($tags as $key => $tags_name) {
            $tags_data = array('name' => $tags_name);
            $has_tag = StylistTags::where('name', $tags_name)->first();
            if ($has_tag) {
                $tags[$key] = $has_tag->id;
            } else {
                $tag_obj = StylistTags::create($tags_data);
                $tags[$key] = $tag_obj->id;
            }

        }

        // compact($questions_array)='';

        $questions_array[] = array(
            'name' => 'Where do you work?',
            'type' => 'text',
            'question_catogary' => $questions_category_id[1],
            'required' => 'Y',
            'section_heading' => 0,
            'fix_rand_id' => 'fix_rand_id_1',
        );

        $questions_array[] = array(
            'name' => 'What\'s your position?',
            'type' => 'text',
            'question_catogary' => $questions_category_id[1],
            'required' => 'Y',
            'section_heading' => 0,
            'fix_rand_id' => 'fix_rand_id_2',
        );

        $questions_array[] = array(
            'name' => 'What are your career aspirations?',
            'type' => 'longtext',
            'question_catogary' => $questions_category_id[1],
            'required' => 'Y',
            'section_heading' => 0,
            'fix_rand_id' => 'fix_rand_id_3',

        );

        // ---------------------------Tell us about your appearance----------------------------------------------

        $questions_array[] = array(
            'name' => 'Skin Colour',
            'description' => 'To build a flexible & cohesive wardrobe, we need to make sure we choose colours perfect for your complexion and appearance.',
            'type' => 'select',
            'anwer_type' => 'img',
            'multiple_select' => 'N',
            'question_catogary' => $questions_category_id[2],
            'required' => 'Y',
            'section_heading' => 0,
            'tag_category_id' => $tag_category[1],
            'fix_rand_id' => 'fix_rand_id_4',
            'answer' => array(
                array('answername' => 'Black', 'image_name' => 'black.jpg', 'tag_id' => $tags[24]),
                array('answername' => 'Brown', 'image_name' => 'brown.jpg', 'tag_id' => $tags[25]),
                array('answername' => 'Olive', 'image_name' => 'olive.jpg', 'tag_id' => $tags[26]),
                array('answername' => 'Tanned', 'image_name' => 'tanned.jpg', 'tag_id' => $tags[27]),
                array('answername' => 'White (freckles)', 'image_name' => 'white_freckles.jpg', 'tag_id' => $tags[28]),
                array('answername' => 'White (no freckles)', 'image_name' => 'white_no_freckles.jpg', 'tag_id' => $tags[29]),
                array('answername' => 'Prefer not to say', 'image_name' => '0_Icon_I_don_t_wear_jewellery.webp', 'tag_id' => $tags[30]),
                array('answername' => 'Other', 'image_name' => 'eye_colour_other.png' , 'has_logn_text_ans' => 'Y'),
            ),
        );

        $questions_array[] = array(
            'description' => 'To build a flexible & cohesive wardrobe, we need to make sure we choose colours perfect for your complexion and appearance.',
            'name' => 'Hair Colour',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[2],
            'required' => 'Y',
            'multiple_select' => 'N',
            'section_heading' => 0,
            'tag_category_id' => $tag_category[2],
            'fix_rand_id' => 'fix_rand_id_5',
            'answer' => array(
                array('answername' => 'Black', 'image_name' => 'black.jpg', 'tag_id' => $tags[24]),
                array('answername' => 'Dark Brown', 'image_name' => 'dark_brown.jpg', 'tag_id' => $tags[31]),
                array('answername' => 'Light Brown', 'image_name' => 'light_brown.jpg', 'tag_id' => $tags[32]),
                array('answername' => 'Blonde', 'image_name' => 'blonde.jpg', 'tag_id' => $tags[33]),
                array('answername' => 'Auburn', 'image_name' => 'auburn.jpg', 'tag_id' => $tags[34]),
                array('answername' => 'Ginger', 'image_name' => 'ginger.jpg', 'tag_id' => $tags[35]),
                array('answername' => 'Grey', 'image_name' => 'grey.jpg', 'tag_id' => $tags[36]),
                array('answername' => 'White', 'image_name' => 'white.jpg', 'tag_id' => $tags[37]),
                array('answername' => 'No hair', 'image_name' => '0_Icon_I_don_t_wear_jewellery.webp' , 'tag_id' => $tags[38]),
                array('answername' => 'Other', 'image_name' => 'eye_colour_other.png' , 'has_logn_text_ans' => 'Y'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Eye Colour',
            'description' => 'To build a flexible & cohesive wardrobe, we need to make sure we choose colours perfect for your complexion and appearance.',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[2],
            'answer_id' => 2,
            'required' => 'Y',
            'multiple_select' => 'N',
            'section_heading' => 0,
            'tag_category_id' => $tag_category[3],
            'fix_rand_id' => 'fix_rand_id_6',
            'answer' => array(
                array('answername' => 'Green', 'image_name' => 'green.jpg', 'tag_id' => $tags[39]),
                array('answername' => 'Hazel', 'image_name' => 'hazel.jpg', 'tag_id' => $tags[40]),
                array('answername' => 'Brown', 'image_name' => 'brown.jpg', 'tag_id' => $tags[25]),
                array('answername' => 'Blue', 'image_name' => 'blue.jpg', 'tag_id' => $tags[41]),
                array('answername' => 'Grey', 'image_name' => 'grey.jpg', 'tag_id' => $tags[36]),
                array('answername' => 'Other', 'image_name' => 'eye_colour_other.png', 'has_logn_text_ans' => 'Y'),
            ),
        );

        // -----To ensure we respectfully communicate with you & build an authentic wardrobe that represents you-------
        $questions_array[] = array(
            'name' => 'For the purposes of clothing, where do you typically shop? ',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[2],
            'answer_id' => 3,
            'required' => 'Y',
            'multiple_select' => 'N',
            'depend_on_ans' => 'Y',
            'skip_id' => 'men_women_combine_q',
            'section_heading' => 0,
            'fix_rand_id' => 'fix_rand_id_7',
            'answer' => array(
                array('answername' => 'Menswear department ', 'depend_cat_id' => $questions_category_id[4], 'tag_id' => $tags[1], 'value' => 'men'),
                array('answername' => 'Womenswear department ', 'depend_cat_id' => $questions_category_id[3], 'tag_id' => $tags[2], 'value' => 'women'),
                array('answername' => 'Combination', 'tag_id' => $tags[3], 'value' => 'combine'),
            ),
        );

        // -----------------------------------------WOMEN’S QUESTIONNAIRE----------------------------------------------
        // -----------------------------------------SIZING & BODYSHAPE-------------------------------------------------

        $questions_array[] = array(
            'name' => 'How tall are you in cm?',
            'type' => 'text',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'tag_category_id' => $tag_category[4],
            'fix_rand_id' => 'fix_rand_id_8',
            'tag_status' => 'Y',

            /*'description' => 'We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.'*/
        );

        $questions_array[] = array(
            'name' => 'What is your weight in kg?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_9',
            'multiple_select' => 'N',
            'description' => 'We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.',
            'answer' => array(
                array('answername' => 'Below 50'),
                array('answername' => '50-60'),
                array('answername' => '60-70'),
                array('answername' => '70-80'),
                array('answername' => '80-90'),
                array('answername' => '90-100'),
                array('answername' => 'Above 100'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What AU size <b>top</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'tag_category_id' => $tag_category[5],
            'fix_rand_id' => 'fix_rand_id_10',

            'answer' => array(
                array('answername' => 'XXS / 4', 'tag_id' => $tags[42],),
                array('answername' => 'XS / 6', 'tag_id' => $tags[43],),
                array('answername' => 'S / 8', 'tag_id' => $tags[44],),
                array('answername' => 'M / 10', 'tag_id' => $tags[45],),
                array('answername' => 'L /12', 'tag_id' => $tags[46],),
                array('answername' => 'XL / 14', 'tag_id' => $tags[47],),
                array('answername' => 'XXL / 16', 'tag_id' => $tags[48],),
                array('answername' => 'XXXL / 18', 'tag_id' => $tags[49],),
                array('answername' => '3XL / 20', 'tag_id' => $tags[50],),
                array('answername' => '4XL / 22', 'tag_id' => $tags[51],),
            ),
        );

        $questions_array[] = array(
            'name' => 'What size <b>bra cup</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'fix_rand_id' => 'fix_rand_id_11',
            'answer' => array(
                array('answername' => 'A'),
                array('answername' => 'B'),
                array('answername' => 'C'),
                array('answername' => 'D'),
                array('answername' => 'DD'),
                array('answername' => 'E'),
                array('answername' => 'F or above'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What AU size <b>dress</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'fix_rand_id' => 'fix_rand_id_12',

            'answer' => array(
                array('answername' => 'XXS / 4'),
                array('answername' => 'XS / 6'),
                array('answername' => 'S / 8'),
                array('answername' => 'M / 10'),
                array('answername' => 'L /12'),
                array('answername' => 'XL / 14'),
                array('answername' => 'XXL / 16'),
                array('answername' => 'XXXL / 18'),
                array('answername' => '3XL / 20'),
                array('answername' => '4XL / 22'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What AU size <b>bottoms</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'tag_category_id' => $tag_category[6],
            'multiple_answer_limit' => '2',
            'fix_rand_id' => 'fix_rand_id_13',

            'answer' => array(
                array('answername' => 'XXS / 4', 'tag_id' => $tags[42]),
                array('answername' => 'XS / 6', 'tag_id' => $tags[43]),
                array('answername' => 'S / 8', 'tag_id' => $tags[44]),
                array('answername' => 'M / 10', 'tag_id' => $tags[45]),
                array('answername' => 'L /12', 'tag_id' => $tags[46]),
                array('answername' => 'XL / 14', 'tag_id' => $tags[47]),
                array('answername' => 'XXL / 16', 'tag_id' => $tags[48]),
                array('answername' => 'XXXL / 18', 'tag_id' => $tags[49]),
                array('answername' => '3XL / 20', 'tag_id' => $tags[50]),
                array('answername' => '4XL / 22', 'tag_id' => $tags[51]),
            ),
        );

        $questions_array[] = array(
            'name' => 'What size <b>jean</b> waist do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'fix_rand_id' => 'fix_rand_id_14',

            'answer' => array(
                array('answername' => '-- / 4'),
                array('answername' => 'XS / 6'),
                array('answername' => '25 / 7'),
                array('answername' => '26 / 8'),
                array('answername' => '27 / 9'),
                array('answername' => '28 / 10'),
                array('answername' => '29 / 11'),
                array('answername' => '30 / 12'),
                array('answername' => '31 / 13'),
                array('answername' => '32 / 14'),
                array('answername' => '33 / 15'),
                array('answername' => '34 / 16'),
                array('answername' => '36 / 18'),
                array('answername' => '-- / 20'),
                array('answername' => '-- / 22'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What size <b>shoe</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'tag_category_id' => $tag_category[7],
            'fix_rand_id' => 'fix_rand_id_15',

            'answer' => array(
                array('answername' => '35', 'tag_id' => $tags[52]),
                array('answername' => '35.5', 'tag_id' => $tags[53]),
                array('answername' => '36', 'tag_id' => $tags[54]),
                array('answername' => '36.5', 'tag_id' => $tags[55]),
                array('answername' => '37', 'tag_id' => $tags[56]),
                array('answername' => '37.5', 'tag_id' => $tags[57]),
                array('answername' => '38', 'tag_id' => $tags[58]),
                array('answername' => '38.5', 'tag_id' => $tags[59]),
                array('answername' => '39', 'tag_id' => $tags[60]),
                array('answername' => '39.5', 'tag_id' => $tags[61]),
                array('answername' => '40', 'tag_id' => $tags[62]),
                array('answername' => '40.5', 'tag_id' => $tags[63]),
                array('answername' => '41', 'tag_id' => $tags[64]),
                array('answername' => '41.5', 'tag_id' => $tags[65]),
                array('answername' => '42', 'tag_id' => $tags[66]),
            ),
        );

        $questions_array[] = array(
            'name' => 'How do you like your clothing to fit on your top half?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_16',
            'multiple_select' => 'Y',
            'description' => "Select as many as you like. We know it can depend what you're wearing on the bottom.",
            'answer' => array(
                array('answername' => 'Tight'),
                array('answername' => 'Fitted'),
                array('answername' => 'Straight'),
                array('answername' => 'Loose'),
                array('answername' => 'Oversized'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How do you like your clothing to fit on your bottom half?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_17',
            'description' => "Select as many as you like. We know it can depend what you're wearing on the top.",
            'answer' => array(
                array('answername' => 'Tight'),
                array('answername' => 'Fitted'),
                array('answername' => 'Straight'),
                array('answername' => 'Loose'),
                array('answername' => 'Oversized'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Body parts you love most?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_18',
            'answer' => array(
                array('answername' => 'Arms'),
                array('answername' => 'Back'),
                array('answername' => 'Décolletage'),
                array('answername' => 'Derriere'),
                array('answername' => 'Legs'),
                array('answername' => 'Stomach'),
                array('answername' => 'All of the above'),
                array('answername' => 'None of the above'),
                array('answername' => 'Other', 'blogn_to' => 'answer_id', 'has_logn_text_ans' => 'Y'),
            ),
        );

        // $questions_array[] = array(
        //     'name' => 'Please tell us what body parts you love most?',
        //     'type' => 'text',
        //     'anwer_type' => 'belog',
        //     'question_catogary' => $questions_category_id[3],
        //     'required' => 'Y',
        //     'section_heading' => $question_name_section[1],
        //     'multiple_select' => 'N',
        // );

        $questions_array[] = array(
            'name' => 'Body parts you\'d like to draw the eye away from?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_19',
            'answer' => array(
                array('answername' => 'Arms'),
                array('answername' => 'Back'),
                array('answername' => 'Décolletage'),
                array('answername' => 'Derrière'),
                array('answername' => 'Legs'),
                array('answername' => 'Stomach'),
                // array('answername' => 'All of the above-I'),
                array('answername' => 'None - I like my body'),
                array('answername' => 'Other', 'blogn_to' => 'answer_id', 'has_logn_text_ans' => 'Y'),
            ),
        );

        //  $questions_array[] = array(
        //     'name' => 'Please tell us what body parts you\'d like to draw the eye away form?',
        //     'type' => 'text',
        //     'anwer_type' => 'belog',
        //     'question_catogary' => $questions_category_id[3],
        //     'required' => 'Y',
        //     'section_heading' => $question_name_section[1],
        //     'multiple_select' => 'N',
        // );

        $questions_array[] = array(
            'name' => 'When purchasing <b>long sleeve tops or jackets</b> I typically find the sleeves',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_20',
            'answer' => array(
                array('answername' => 'Too short and normally exposes the wrist bones', 'tag_id' => $tags[4]),
                array('answername' => 'Fits comfortably around the wrist bone'),
                // array('answername' => 'Too long and cover half or all of my hand', 'tag_id' => $tags[6]),
                array('answername' => 'Too long and covers part of my hand', 'tag_id' => $tags[6]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing a <b>shirt or top</b> I typically find the chest area',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_21',
            'answer' => array(
                // array('answername' => 'Tight and often pull', 'tag_id' => $tags[7]),
                array('answername' => 'Tight and often pulls', 'tag_id' => $tags[7]),
                array('answername' => 'Fits comfortably & nicely'),
                array('answername' => 'Has plenty of room', 'tag_id' => $tags[9]),
            ),
        );

        $questions_array[] = array(
            'name' => 'Look at yourself in a mirror, the tips of my shoulders visually sit',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_22',
            'answer' => array(
                array('answername' => 'Narrower than my thighs ', 'blogn_to' => 'skip_next_question' ,'tag_id' => $tags[10]),
                array('answername' => 'In line with my thigh width'),
                array('answername' => 'Wider than my thighs' ,'tag_id' => $tags[12]),
            ),
        );

        // $questions_array[] = array(
        //     'name' => 'Do you often find shirts & tops are tight across your back and/or tight under the arm on most occasions?',
        //     'type' => 'select',
        //     'anwer_type' => '',
        //     'question_catogary' => $questions_category_id[3],
        //     'required' => 'Y',
        //     'depending_question' => 'Y',
        //      'fix_rand_id' => 'fix_rand_id_23',
        //     'section_heading' => $question_name_section[1],
        //     'multiple_select' => 'N',
        //     'answer' => array(
        //         array('answername' => 'Yes'),
        //         array('answername' => 'No'),
        //     ),
        // );

        $questions_array[] = array(
            'name' => 'When purchasing <b>shirts or tops</b> I typically find the torso length of the top',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_24',
            'answer' => array(
                array('answername' => 'Short and exposes my belly', 'tag_id' => $tags[13]),
                array('answername' => 'Fits nicely', 'tag_id' => $tags[14]),
                array('answername' => 'Long and generally sits below the crotch', 'tag_id' => $tags[15]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing a <b>classic fitted top</b> I find my waist is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_25',
            'answer' => array(
                array('answername' => 'Hidden and needs to be belted to show my curve', 'tag_id' => $tags[16]),
                array('answername' => 'Slightly hidden but the top fits nicely without a belt. However, it also could be belted', 'tag_id' => $tags[17]),
                array('answername' => 'Appears fairly straight and a belt wouldn’t accentuate any further waist curve', 'tag_id' => $tags[18]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing <b>full length pants</b> I typically find the length',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_26',
            'answer' => array(
                array('answername' => 'Short & I need to get hem taken down', 'tag_id' => $tags[22]),
                array('answername' => 'Fits perfectly',),
                array('answername' => 'Long with excess fabric & need to get hem taken up', 'tag_id' => $tags[23]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing <b>fitted pants or jeans</b> I typically find the thigh area',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_27',
            'answer' => array(
                array('answername' => 'Tight & can often pull. I sometimes size up because of tightness', 'tag_id' => $tags[19]),
                // array('answername' => 'Well fitted but generally doesn&#39;t noticeably pull', 'tag_id' => $tags[20]),
                array('answername' => 'Well fitted & generally doesn&#39;t pull', 'tag_id' => $tags[20]),
                // array('answername' => 'Can be roomy. Can often have too much fabric and not fitted around thigh.', 'tag_id' => $tags[21]),
                // array('answername' => 'Too much fabric and not fitted around my thigh', 'tag_id' => $tags[21]),
                array('answername' => 'Too much fabric and not fitted around my thigh', 'tag_id' => $tags[21]),
            ),
        );

        $questions_array[] = array(
            'name' => 'Is there anything you would like us to know about fit challenges?',
            'type' => 'longtext',
            'anwer_type' => 'select',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_28',
        );

        $questions_array[] = array(
            'name' => 'Please upload a recent full body photo of yourself',
            'type' => 'single',
            'anwer_type' => 'upload',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_29',
        );

        // ---------------------------------SIZING & BODYSHAPE-------------------------------------------------------

        $questions_array[] = array(
            'name' => 'How tall are you in cm?',
            'type' => 'text',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'tag_category_id' => $tag_category[4],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_30',
            'tag_status' => 'Y',
            /* 'description' => 'We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.'*/
        );

        $questions_array[] = array(
            'name' => 'What is your weight in kg?',
            'type' => 'text',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'description' => 'We know this is a sensitive topic - your answer helps us build an accurate profile and is completely confidential and only shared with your stylist.',
            'fix_rand_id' => 'fix_rand_id_31',
        );

        $questions_array[] = array(
            'name' => 'What AU size <b>shirt/top</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_32',
            'multiple_answer_limit' => '2',
            'tag_category_id' => $tag_category[5],
            'answer' => array(
                array('answername' => 'XS / 36', 'tag_id' => $tags[67]),
                array('answername' => 'S / 38', 'tag_id' => $tags[68]),
                array('answername' => 'M / 40', 'tag_id' => $tags[69]),
                array('answername' => 'L / 42', 'tag_id' => $tags[70]),
                array('answername' => 'XL / 44', 'tag_id' => $tags[71]),
                array('answername' => 'XXL / 46', 'tag_id' => $tags[72]),
                array('answername' => '3XL / 48', 'tag_id' => $tags[73]),
                array('answername' => '4XL / 50', 'tag_id' => $tags[74]),
            ),
        );

        $questions_array[] = array(
            'name' => 'What AU size <b>bottoms</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'tag_category_id' => $tag_category[6],
            'fix_rand_id' => 'fix_rand_id_33',
            'multiple_answer_limit' => '2',
            'answer' => array(
                array('answername' => '28 / XS', 'tag_id' => $tags[75]),
                array('answername' => '30 / S', 'tag_id' => $tags[76]),
                array('answername' => '32 / M', 'tag_id' => $tags[77]),
                array('answername' => '34 / L', 'tag_id' => $tags[78]),
                array('answername' => '36 / XL', 'tag_id' => $tags[79]),
                array('answername' => '38 / XXL', 'tag_id' => $tags[80]),
                array('answername' => '40 / 3XL', 'tag_id' => $tags[81]),
                array('answername' => '42 / 4XL', 'tag_id' => $tags[82]),
            ),
        );

        $questions_array[] = array(
            'name' => 'What length <b>inseam / leg</b> length do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'multiple_answer_limit' => '2',
            'fix_rand_id' => 'fix_rand_id_34',
            'answer' => array(
                array('answername' => '28'),
                array('answername' => '30'),
                array('answername' => '32'),
                array('answername' => '34'),
                array('answername' => '36+'),
                array('answername' => 'Unsure'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What size <b>jacket / blazer</b> do you typically wear?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_35',
            'multiple_answer_limit' => '2',
            'answer' => array(
                array('answername' => 'XS / 36'),
                array('answername' => 'S / 38'),
                array('answername' => 'M / 40'),
                array('answername' => 'L / 42'),
                array('answername' => 'XL / 44'),
                array('answername' => 'XXL / 46'),
                array('answername' => '3XL / 48'),
                array('answername' => '4XL / 50'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What size <b>shoe</b> do you typically wear',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'tag_category_id' => $tag_category[7],
            'fix_rand_id' => 'fix_rand_id_36',
            'multiple_answer_limit' => '2',
            'answer' => array(
                array('answername' => '6 / 40', 'tag_id' => $tags[83]),
                array('answername' => '7 / 41', 'tag_id' => $tags[84]),
                array('answername' => '8 / 42', 'tag_id' => $tags[85]),
                array('answername' => '9 / 43', 'tag_id' => $tags[86]),
                array('answername' => '10 / 44', 'tag_id' => $tags[87]),
                array('answername' => '11 / 45', 'tag_id' => $tags[88]),
                array('answername' => '12 / 46', 'tag_id' => $tags[89]),
                array('answername' => '13+', 'tag_id' => $tags[90]),
            ),
        );

        $questions_array[] = array(
            'name' => 'How do you like your shirts and tops to fit?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_37',
            'answer' => array(
                array('answername' => 'Slim &#8722; fits close to the body'),
                array('answername' => 'Classic or regular &#8722; fits across the chest but is looser than the slim'),
                array('answername' => 'Oversized &#8722; no definition in shape'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How do you like your pants to fit?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_38',
            'answer' => array(

                array('answername' => 'Skinny - close fitting from waist all the way to ankle '),
                array('answername' => 'Slim - close fitting but with more room and wont cling to your ankle'),
                array('answername' => 'Straight - they have a consistent width the whole way down the leg'),
                array('answername' => 'Relaxed - loose with plenty of room. But not baggy'),
            ),
        );

        // $questions_array[] = array(
        //     'name' => 'Body parts you love most?',
        //     'type' => 'select',
        //     'anwer_type' => '',
        //     'question_catogary' => $questions_category_id[4],
        //     'required' => 'Y',
        //     'section_heading' => $question_name_section[1],
        //     'multiple_select' => 'N',
        //     'fix_rand_id' => 'fix_rand_id_39',
        //     'answer' => array(
        //         array('answername' => 'Arms'),
        //         array('answername' => 'Back'),
        //         array('answername' => 'Décolletage'),
        //         array('answername' => 'Derriere'),
        //         array('answername' => 'Legs'),
        //         array('answername' => 'Stomach'),
        //         array('answername' => 'All of the above'),
        //         array('answername' => 'None of the above'),
        //         array('answername' => 'Other','has_logn_text_ans' => 'Y'),
        //     ),
        // );

        // $questions_array[] = array(
        //     'name' => 'Body parts you\'d like to draw the eye away from?',
        //     'type' => 'select',
        //     'anwer_type' => '',
        //     'question_catogary' => $questions_category_id[4],
        //     'required' => 'Y',
        //     'section_heading' => $question_name_section[1],
        //     'multiple_select' => 'N',
        //     'fix_rand_id' => 'fix_rand_id_40',
        //     'answer' => array(
        //         array('answername' => 'Arms'),
        //         array('answername' => 'Back'),
        //         array('answername' => 'Décolletage'),
        //         array('answername' => 'Derriere'),
        //         array('answername' => 'Legs'),
        //         array('answername' => 'Stomach'),
        //         //array('answername' => 'None of the above &#8722; I '),
        //         array('answername' => 'None - I like my body'),
        //         array('answername' => 'Other','has_logn_text_ans' => 'Y'),
        //     ),
        // );

        $questions_array[] = array(
            'name' => 'What best describes your body type?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_41',
            'answer' => array(
                array('answername' => 'Slim'),
                array('answername' => 'Average'),
                array('answername' => 'Muscular'),
                array('answername' => 'Solid / Burley'),
                array('answername' => 'Teddy Bear'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y'),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on shirts how does the <b>collar</b> typically fit?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_42',
            'answer' => array(
                array('answername' => 'Too tight, tend to have to size up', 'tag_id' => $tags[91]),
                array('answername' => 'Too loose'),
                array('answername' => 'No issues, usually fits'),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on a shirt or top I typically find the <b>chest</b> area is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'fix_rand_id' => 'fix_rand_id_43',
            'section_heading' => $question_name_section[1],
            'answer' => array(
                array('answername' => 'Tight and often pulls', 'tag_id' => $tags[92]),
                array('answername' => 'Fits comfortably & nicely'),
                array('answername' => 'Is loose around the chest', 'tag_id' => $tags[93]),
            ),
        );

        $questions_array[] = array(
            'name' => 'Look at yourself in a mirror, the tips of my <b>shoulders</b> visually sit',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_44',
            'answer' => array(
                array('answername' => 'Narrower than my hips', 'tag_id' => $tags[10]),
                array('answername' => 'In line with my hip width', 'tag_id' => $tags[94]),
                array('answername' => 'Wider than my hips', 'tag_id' => $tags[12]),
                array('answername' => 'Much wider than hips', 'tag_id' => $tags[95]),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you often find shirts & tops are tight across your back and/or tight under the arm on most occasions?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_45',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No'),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on shirts or tees I typically find the <b>waist/stomach</b> area is ',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_46',
            'answer' => array(
                array('answername' => 'Tight and often pulls', 'tag_id' => $tags[70]),
                array('answername' => 'Fits comfortably & nicely'),
                array('answername' => 'Is loose around my belly', 'tag_id' => $tags[71]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing shirts or tops I typically find the <b>torso length</b> of the top is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_47',
            'answer' => array(
                array('answername' => 'Short and has potential to expose my belly', 'tag_id' => $tags[98]),
                array('answername' => 'Fits nicely and finishes below my hips'),
                array('answername' => 'Long and generally sits at or below my crotch', 'tag_id' => $tags[15]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When purchasing long sleeve tops I typically find the <b>sleeves</b> are',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_48',
            'answer' => array(
                array('answername' => 'Too short and normally exposes the wrist bones', 'tag_id' => $tags[4]),
                array('answername' => 'Fits comfortably and finished just below wrist bone'),
                array('answername' => 'Too long and cover half or all of my hand'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Are sleeves uncomfortably tight around your bicep?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_49',
            'answer' => array(
                array('answername' => 'Yes', 'tag_id' => $tags[99]),
                array('answername' => 'No'),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on pants or jeans I typically find the <b>thigh</b> area is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_50',
            'answer' => array(
                array('answername' => 'Tight & can often pull. ', 'tag_id' => $tags[100]),
                array('answername' => 'Well fitted but generally doesn&#39;t noticeably pull '),
                array('answername' => 'Loose and has too much fabric around thigh. ', 'tag_id' => $tags[101]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on pants or jeans I typically find the <b>calf</b> area is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_51',
            'answer' => array(
                array('answername' => 'Tight & can often pull. ', 'tag_id' => $tags[102]),
                array('answername' => 'Well fitted but generally doesn&#39;t noticeably pull '),
                array('answername' => 'Loose and has too much fabric around calf. ', 'tag_id' => $tags[103]),
            ),
        );

        $questions_array[] = array(
            'name' => 'When trying on full length pants I typically <b>find the length</b> is',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_52',
            'answer' => array(
                array('answername' => 'Short & I need to get hem taken down to make longer', 'tag_id' => $tags[22]),
                array('answername' => 'Fits perfectly'),
                array('answername' => 'Long with excess fabric & I need to get hem taken up to make shorter', 'tag_id' => $tags[23]),
            ),
        );

        $questions_array[] = array(
            'name' => 'Is there anything you would like us to know about fit challenges?',
            'type' => 'longtext',
            'anwer_type' => 'text',
            'question_catogary' => $questions_category_id[4],
            'required' => 'N',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_53',
        );

        // $questions_array[] = array(
        //     'name' => 'Questions I haven\'t asked… Booty',
        //     'type' => 'longtext',
        //     'anwer_type' => 'text',
        //     'question_catogary' => $questions_category_id[4],
        //     'required' => 'Y',
        //     'section_heading' => $question_name_section[1],
        //     'fix_rand_id' => 'fix_rand_id_54',
        // );

        $questions_array[] = array(
            'name' => 'Please upload a recent full body photo of yourself',
            'type' => 'image',
            'anwer_type' => 'upload',
            'question_catogary' => $questions_category_id[4],
            'required' => 'N',
            'section_heading' => $question_name_section[1],
            'fix_rand_id' => 'fix_rand_id_55',
        );

        // ------------------------------PERSONAL STYLE---------------------------------------------------------

        $questions_array[] = array(
            'name' => 'How would you describe your current style?',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_56',
            'description' => "Select as many images you would like",

            'answer' => array(
                array('answername' => 'Alternative Edgy', 'image_name' => 'women_alternative_edgy.jpg'),
                array('answername' => 'Androgynous', 'image_name' => 'women_androgynous.jpg'),
                array('answername' => 'Bohemium', 'image_name' => 'women_bohemium.jpg'),
                array('answername' => 'Casual', 'image_name' => 'women_casual.jpg'),
                array('answername' => 'Corporate', 'image_name' => 'women_corporate.jpg'),
                array('answername' => 'Elegant', 'image_name' => 'women_elegant.jpg'),
                array('answername' => 'Fashion Forward', 'image_name' => 'women_fashion_forward.jpg'),
                array('answername' => 'Girly', 'image_name' => 'women_girly.jpg'),
                array('answername' => 'Preppy', 'image_name' => 'women_preppy.jpg'),
                array('answername' => 'Street', 'image_name' => 'women_street.jpg'),
                array('answername' => 'Vintage', 'image_name' => 'women_vintage.jpg'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y', 'image_name' => 'other.webp' ),

            ),
        );

        $questions_array[] = array(
            'name' => 'Do you like your current style?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_57',
            'answer' => array(
                array('answername' => 'I need some help'),
                array('answername' => 'Somewhat'),
                array('answername' => 'I love my style'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select the styles you like most',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'Y',
            // 'hide_answer_label' => 'Y',
            'fix_rand_id' => 'fix_rand_id_58',
            'answer' => array(
                array('answername' => '', 'image_name' => 'women_alternative_edgy_2.png'),
                array('answername' => '', 'image_name' => 'women_alternative_edgy_3.png'),
                array('answername' => '', 'image_name' => 'women_alternative_edgy_4.png'),
                array('answername' => '', 'image_name' => 'women_androgynous_1.png'),
                array('answername' => '', 'image_name' => 'women_androgynous_2.png'),
                array('answername' => '', 'image_name' => 'women_androgynous_3.png'),
                array('answername' => '', 'image_name' => 'women_androgynous_4.png'),
                array('answername' => '', 'image_name' => 'women_artistic_1.png'),
                array('answername' => '', 'image_name' => 'women_artistic_2.png'),
                array('answername' => '', 'image_name' => 'women_bohemium_0000_b714a689c34b0418b7660fc0835a9dfe.png'),
                array('answername' => '', 'image_name' => 'women_bohemium_0001_3233b52c1d5469d6920d575189b834b0.png'),
                array('answername' => '', 'image_name' => 'women_bohemium_0002_36ec3e07baf77f35ecb33c1a6e0abe87.png'),
                array('answername' => '', 'image_name' => 'women_bohemium_0003_Layer 2 copy.png'),
                array('answername' => '', 'image_name' => 'women_bold_1.png'),
                array('answername' => '', 'image_name' => 'women_bold_2.png'),
                array('answername' => '', 'image_name' => 'women_bold_3.png'),
                array('answername' => '', 'image_name' => 'women_bold_4.png'),
                array('answername' => '', 'image_name' => 'women_casual_1.png'),
                array('answername' => '', 'image_name' => 'women_casual_2.png'),
                array('answername' => '', 'image_name' => 'women_casual_3.png'),
                array('answername' => '', 'image_name' => 'women_casual_4.png'),
                array('answername' => '', 'image_name' => 'women_classic_1.png'),
                array('answername' => '', 'image_name' => 'women_classic_2.png'),
                array('answername' => '', 'image_name' => 'women_classic_3.png'),
                array('answername' => '', 'image_name' => 'women_classic_4.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0000_1.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0001_2.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0002_3.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0003_4.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0004_5.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0005_6.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0006_7.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0007_8.png'),
                array('answername' => '', 'image_name' => 'women_corporate_0008_9.png'),
                array('answername' => '', 'image_name' => 'women_daggy.png'),
                array('answername' => '', 'image_name' => 'women_daggy_2.png'),
                array('answername' => '', 'image_name' => 'women_daggy_3.png'),
                array('answername' => '', 'image_name' => 'women_daggy_4.png'),
                array('answername' => '', 'image_name' => 'women_elegant_1.png'),
                array('answername' => '', 'image_name' => 'women_elegant_2.png'),
                array('answername' => '', 'image_name' => 'women_elegant_3.png'),
                array('answername' => '', 'image_name' => 'women_fashion-forward_1.png'),
                array('answername' => '', 'image_name' => 'women_fashion-forward_2.png'),
                array('answername' => '', 'image_name' => 'women_fashion-forward_3.png'),
                array('answername' => '', 'image_name' => 'women_fashion-Forward_4.png'),
                array('answername' => '', 'image_name' => 'women_girly_1.png'),
                array('answername' => '', 'image_name' => 'women_girly_2.png'),
                array('answername' => '', 'image_name' => 'women_girly_3.png'),
                array('answername' => '', 'image_name' => 'women_girly_4.png'),
                array('answername' => '', 'image_name' => 'women_girly_5.png'),
                array('answername' => '', 'image_name' => 'women_plus_0000_1.png'),
                array('answername' => '', 'image_name' => 'women_plus_0001_2.png'),
                array('answername' => '', 'image_name' => 'women_plus_0002_3.png'),
                array('answername' => '', 'image_name' => 'women_plus_0003_4.png'),
                array('answername' => '', 'image_name' => 'women_plus_0004_5.png'),
                array('answername' => '', 'image_name' => 'women_plus_0005_6.png'),
                array('answername' => '', 'image_name' => 'women_plus_0006_7.png'),
                array('answername' => '', 'image_name' => 'women_plus_0007_8.png'),
                array('answername' => '', 'image_name' => 'women_plus_0008_9.png'),
                array('answername' => '', 'image_name' => 'women_plus_0009_10.png'),
                array('answername' => '', 'image_name' => 'women_plus_0010_11.png'),
                array('answername' => '', 'image_name' => 'women_preppy_1.png'),
                array('answername' => '', 'image_name' => 'women_preppy_2.png'),
                array('answername' => '', 'image_name' => 'women_preppy_3.png'),
                array('answername' => '', 'image_name' => 'women_preppy_4.png'),
                array('answername' => '', 'image_name' => 'women_street_1.png'),
                array('answername' => '', 'image_name' => 'women_street_2.png'),
                array('answername' => '', 'image_name' => 'women_street_3.png'),
                array('answername' => '', 'image_name' => 'women_vintage_1.png'),
                array('answername' => '', 'image_name' => 'women_vintage_2.png'),
                array('answername' => '', 'image_name' => 'women_vintage_3.png'),
                array('answername' => '', 'image_name' => 'women_vintage_4.png'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you have a Pinterest account with style inspiration? Share the link with us.',
            'type' => 'text',
            'anwer_type' => 'text_id',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_59',
        );

        $questions_array[] = array(
            'name' => 'How much time do you put into getting your daily look?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_60',
            'answer' => array(
                array('answername' => '15min or less'),
                array('answername' => '30min - 1hr'),
                array('answername' => '1hr+'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you try out the latest styles and trends?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_61',
            'answer' => array(
                array('answername' => 'Never'),
                array('answername' => 'Rarely'),
                array('answername' => 'Occasionally'),
                array('answername' => 'Always'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Would you like us to be adventurous with your garment selections?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_62',
            'answer' => array(
                array('answername' => 'No, stick with what I\'m comfortable with'),
                array('answername' => 'Somewhat'),
                array('answername' => 'Yes, push my style'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What brands do you typically purchase?',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_63',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => '', 'image_name' => 'women_brand_acne_studios_1.webp'),
                array('answername' => '', 'image_name' => 'women_brand_aje_2.webp'),
                array('answername' => '', 'image_name' => 'women_brand_bec_bridge_3.webp'),
                array('answername' => '', 'image_name' => 'women_brand_bul_4.webp'),
                array('answername' => '', 'image_name' => 'women_brand_country_road_5.webp'),
                array('answername' => '', 'image_name' => 'women_brand_cue_6.webp'),
                array('answername' => '', 'image_name' => 'women_brand_david_jones_7.webp'),
                array('answername' => '', 'image_name' => 'women_brand_dion_lee_8.webp'),
                array('answername' => '', 'image_name' => 'women_brand_french_connection_9.webp'),
                array('answername' => '', 'image_name' => 'women_brand_ginger_smart_10.webp'),
                array('answername' => '', 'image_name' => 'women_brand_gorman_11.webp'),
                array('answername' => '', 'image_name' => 'women_brand_h_m_12.webp'),
                array('answername' => '', 'image_name' => 'women_brand_jacqui_e_13.webp'),
                array('answername' => '', 'image_name' => 'women_brand_kmart_14.webp'),
                array('answername' => '', 'image_name' => 'women_brand_manning_cartell_15.webp'),
                array('answername' => '', 'image_name' => 'women_brand_myer_16.webp'),
                array('answername' => '', 'image_name' => 'women_brand_portmans_17.webp'),
                array('answername' => '', 'image_name' => 'women_brand_reiss_18.webp'),
                array('answername' => '', 'image_name' => 'women_brand_review_19.webp'),
                array('answername' => '', 'image_name' => 'women_brand_saba_20.webp'),
                array('answername' => '', 'image_name' => 'women_brand_sass_bide_21.webp'),
                array('answername' => '', 'image_name' => 'women_brand_scanlan_theodore_22.webp'),
                array('answername' => '', 'image_name' => 'women_brand_seed_23.webp'),
                array('answername' => '', 'image_name' => 'women_brand_sport_girl_24.webp'),
                array('answername' => '', 'image_name' => 'women_brand_target_25.webp'),
                array('answername' => '', 'image_name' => 'women_brand_ted_baker_26.webp'),
                array('answername' => '', 'image_name' => 'women_brand_tony_bianco_27.webp'),
                array('answername' => '', 'image_name' => 'women_brand_veronika_maine_28.webp'),
                array('answername' => '', 'image_name' => 'women_brand_victoria_woods_29.webp'),
                array('answername' => '', 'image_name' => 'women_brand_witchery_30.webp'),
                array('answername' => '', 'image_name' => 'women_brand_wittner_31.webp'),
                array('answername' => '', 'image_name' => 'women_brand_zara_32.webp'),
                array('answername' => '', 'image_name' => 'women_brand_zimmermann_33.webp'),
                array('answername' => '', 'image_name' => '0_Icon_None_of_the_above.webp'),
                array('answername' => 'Other', 'image_name' => 'other.webp', 'has_logn_text_ans' => 'Y'),
            ),
        );

        // ---------------------------------------------------------------------------------------------------------
        $questions_array[] = array(
            'name' => 'How would you describe your current style?',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_64',
            'multiple_select' => 'Y',
            'description' => "Select as many images you would like",
            'answer' => array(
                array('answername' => 'Alternative / Edgy', 'image_name' => 'men_alternative_edgy.jpg'),
                array('answername' => 'Bold', 'image_name' => 'men_bold.jpg'),
                array('answername' => 'Classic', 'image_name' => 'men_classic.jpg'),
                array('answername' => 'Corporate', 'image_name' => 'men_corporate.jpg'),
                array('answername' => 'Fashionista', 'image_name' => 'men_fashionista.jpg'),
                array('answername' => 'Preppy', 'image_name' => 'men_preppy.jpg'),
                array('answername' => 'Ruggard', 'image_name' => 'men_ruggard_2.png'),
                array('answername' => 'Street', 'image_name' => 'men_street.jpg'),
                array('answername' => 'I have no idea', 'image_name' => '0_Icon_None_of_the_above.webp'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y', 'image_name' => 'other.webp'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you like your current style?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_65',
            'answer' => array(
                array('answername' => 'I need some help'),
                array('answername' => 'Somewhat'),
                array('answername' => 'I love my style'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select the styles you like most',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_66',
            'answer' => array(
                array('answername' => '', 'image_name' => 'man_alternative---edgy-1.png'),
                array('answername' => '', 'image_name' => 'men_alternative---edgy-2.png'),
                array('answername' => '', 'image_name' => 'men_alternative---edgy-3.png'),
                array('answername' => '', 'image_name' => 'men_alternative-edgy-4.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored_1.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored_2.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored_3.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored_4.png'),
                array('answername' => '', 'image_name' => 'men_casual_tailored_5.png'),
                array('answername' => '', 'image_name' => 'men_classic_1.png'),
                array('answername' => '', 'image_name' => 'men_classic_2.png'),
                array('answername' => '', 'image_name' => 'men_classic_3.png'),
                array('answername' => '', 'image_name' => 'men_classic_bold.png'),
                array('answername' => '', 'image_name' => 'men_classic_clean.png'),
                array('answername' => '', 'image_name' => 'men_corporate_1.png'),
                array('answername' => '', 'image_name' => 'men_corporate_2.png'),
                array('answername' => '', 'image_name' => 'men_corporate_3.png'),
                array('answername' => '', 'image_name' => 'men_corporate_4.png'),
                array('answername' => '', 'image_name' => 'men_corporate_bold_1.png'),
                array('answername' => '', 'image_name' => 'men_corporate_bold_2.png'),
                array('answername' => '', 'image_name' => 'men_corporate_bold_3.png'),
                array('answername' => '', 'image_name' => 'men_corporate_bold_4.png'),
                array('answername' => '', 'image_name' => 'men_corporate_plus.png'),
                array('answername' => '', 'image_name' => 'men_creative_1.png'),
                array('answername' => '', 'image_name' => 'men_creative_2.png'),
                array('answername' => '', 'image_name' => 'men_creative_3.png'),
                array('answername' => '', 'image_name' => 'men_creative_4.png'),
                array('answername' => '', 'image_name' => 'men_daggy_1.png'),
                array('answername' => '', 'image_name' => 'men_daggy_2.png'),
                array('answername' => '', 'image_name' => 'men_daggy_3.png'),
                array('answername' => '', 'image_name' => 'men_daggy_4.png'),
                array('answername' => '', 'image_name' => 'men_daggy_5.png'),
                array('answername' => '', 'image_name' => 'men_euro_1.png'),
                array('answername' => '', 'image_name' => 'men_euro_2.png'),
                array('answername' => '', 'image_name' => 'men_euro_3.png'),
                array('answername' => '', 'image_name' => 'men_flam-4.png'),
                array('answername' => '', 'image_name' => 'men_flamboyant-1.png'),
                array('answername' => '', 'image_name' => 'men_flamboyant-2.png'),
                array('answername' => '', 'image_name' => 'men_flamboyant-3.png'),
                array('answername' => '', 'image_name' => 'men_flamboyant-4.png'),
                array('answername' => '', 'image_name' => 'men_minimalist-1.png'),
                array('answername' => '', 'image_name' => 'men_minimalist-2.png'),
                array('answername' => '', 'image_name' => 'men_minimalist-3.png'),
                array('answername' => '', 'image_name' => 'men_minimalist-4.png'),
                array('answername' => '', 'image_name' => 'men_plus_2.png'),
                array('answername' => '', 'image_name' => 'men_plus_3.png'),
                array('answername' => '', 'image_name' => 'men_plus_4.png'),
                array('answername' => '', 'image_name' => 'men_preppy_1.png'),
                array('answername' => '', 'image_name' => 'men_preppy_2.png'),
                array('answername' => '', 'image_name' => 'men_preppy_3.png'),
                array('answername' => '', 'image_name' => 'men_preppy_4.png'),
                array('answername' => '', 'image_name' => 'men_preppy_5.png'),
                array('answername' => '', 'image_name' => 'men_preppy_6.png'),
                array('answername' => '', 'image_name' => 'men_ruggard_1.png'),
                array('answername' => '', 'image_name' => 'men_ruggard_2.png'),
                array('answername' => '', 'image_name' => 'men_ruggard_3.png'),
                array('answername' => '', 'image_name' => 'men_ruggard_4.png'),
                array('answername' => '', 'image_name' => 'men_street_1.png'),
                array('answername' => '', 'image_name' => 'men_street_2.png'),
                array('answername' => '', 'image_name' => 'men_street_3.png'),
                array('answername' => '', 'image_name' => 'men_street_4.png'),
                array('answername' => '', 'image_name' => 'men_street_5.png'),
                array('answername' => '', 'image_name' => 'men_vintage_1.png'),
                array('answername' => '', 'image_name' => 'men_vintage_2.png'),
                array('answername' => '', 'image_name' => 'men_vintage_3.png'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you have a Pinterest account with style inspiration? Share the link with us.',
            'type' => 'text',
            'anwer_type' => 'text',
            'question_catogary' => $questions_category_id[4],
            'required' => 'N',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_67',
        );

        $questions_array[] = array(
            'name' => 'How much time do you put into getting your daily look?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_68',
            'answer' => array(
                array('answername' => '15min or less'),
                array('answername' => '30min - 1hr'),
                array('answername' => '1hr+'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you try out the latest styles and trends?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_69',
            'answer' => array(
                array('answername' => 'Never'),
                array('answername' => 'Rarely'),
                array('answername' => 'Occasionally'),
                array('answername' => 'Always'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Would you like us to be adventurous with your garment selections?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_70',
            'answer' => array(
                array('answername' => 'No, stick with what I\'m comfortable with'),
                array('answername' => 'Somewhat'),
                array('answername' => 'Yes, push my style'),
            ),
        );

        $questions_array[] = array(
            'name' => 'What brands do you typically purchase?',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[2],
            'fix_rand_id' => 'fix_rand_id_71',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => '', 'image_name' => 'men_acne_studios_1.webp'),
                array('answername' => '', 'image_name' => 'men_aquila_2.webp'),
                array('answername' => '', 'image_name' => 'men_boss_3.webp'),
                array('answername' => '', 'image_name' => 'men_calibre_4.webp'),
                array('answername' => '', 'image_name' => 'men_converse_5.webp'),
                array('answername' => '', 'image_name' => 'men_cos_6.webp'),
                array('answername' => '', 'image_name' => 'men_country_road_7.webp'),
                array('answername' => '', 'image_name' => 'men_david_Jones_8.webp'),
                array('answername' => '', 'image_name' => 'men_french_connection_9.webp'),
                array('answername' => '', 'image_name' => 'men_h_m_10.webp'),
                array('answername' => '', 'image_name' => 'men_industrie_11.webp'),
                array('answername' => '', 'image_name' => 'men_kmart_12.webp'),
                array('answername' => '', 'image_name' => 'men_levi_s_13.webp'),
                array('answername' => '', 'image_name' => 'men_m_j_bale_14.webp'),
                array('answername' => '', 'image_name' => 'men_marcs_15.webp'),
                array('answername' => '', 'image_name' => 'men_myer_16.webp'),
                array('answername' => '', 'image_name' => 'men_nike_17.webp'),
                array('answername' => '', 'image_name' => 'men_patagonia_18.webp'),
                array('answername' => '', 'image_name' => 'men_politix_19.webp'),
                array('answername' => '', 'image_name' => 'men_ralph_lauren_20.webp'),
                array('answername' => '', 'image_name' => 'men_reiss_21.webp'),
                array('answername' => '', 'image_name' => 'men_rodd_gunn_22.webp'),
                array('answername' => '', 'image_name' => 'men_saba_23.webp'),
                array('answername' => '', 'image_name' => 'men_sportscraft_24.webp'),
                array('answername' => '', 'image_name' => 'men_target_25.webp'),
                array('answername' => '', 'image_name' => 'men_ted_baker_26.webp'),
                array('answername' => '', 'image_name' => 'men_uni_qlo_27.webp'),
                array('answername' => '', 'image_name' => 'men_zara_28.webp'),
                array('answername' => '', 'image_name' => '0_Icon_None_of_the_above.webp'),
                array('answername' => 'Other', 'image_name' => 'other.webp', 'has_logn_text_ans' => 'Y'),
            ),
        );

        // -------------------------------------PREFERRED STYLES-------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select <b>all</b> trouser styles you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_72',
            'answer' => array(
                // array('answername' => 'Flare', 'image_name' => 'Flare.jpg'),
                array('answername' => 'Flare', 'image_name' => 'Flare_2.jpg'),
                // array('answername' => 'High', 'image_name' => 'High.jpg'),
                array('answername' => 'Skinny', 'image_name' => 'Skinny.jpg'),
                array('answername' => 'Straight', 'image_name' => 'Straight.jpg'),
                array('answername' => 'Bootleg', 'image_name' => 'Style_Bootleg.jpg'),
                array('answername' => 'Culotte', 'image_name' => 'Style_Culotte.jpg'),
                array('answername' => 'Tapered', 'image_name' => 'Tapered.jpg'),
                array('answername' => 'Wideleg', 'image_name' => 'Wide.jpg'),
                array('answername' => 'I don\'t wear trousers', 'image_name' => '0_Icon_I_don_t_wear_jewellery.webp', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> trouser rise you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_73',
            'answer' => array(
                // array('answername' => 'Low 1', 'image_name' => 'Low.jpg'),
                // array('answername' => 'Low 2', 'image_name' => 'Low_2.jpg'),
                array('answername' => 'Low rise', 'image_name' => 'Low_Rise.jpg'),
                // array('answername' => 'Mid 1', 'image_name' => 'Mid.jpg'),
                array('answername' => 'Mid rise', 'image_name' => 'Mid_2.jpg'),
                // array('answername' => 'Mid 3', 'image_name' => 'Mid_3.jpg'),
                // array('answername' => 'Mid Rise 1', 'image_name' => 'Mid_Rise.jpg'),
                // array('answername' => 'Mid Rise 2', 'image_name' => 'Mid_Rise_2.jpg'),
                array('answername' => 'High rise', 'image_name' => 'high_Rise_women.webp'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> trouser lengths you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_74',
            'answer' => array(
                array('answername' => 'Ankle', 'image_name' => 'Ankle.jpg'),
                array('answername' => 'Cropped', 'image_name' => 'Cropped.jpg'),
                array('answername' => 'Long', 'image_name' => 'long.png'),
                array('answername' => 'Regular', 'image_name' => 'Regular.jpg'),
                // array('answername' => 'Regular', 'image_name' => 'Regular.jpg'),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select <b>all</b> styles of skirt/dress you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_75',
            'answer' => array(
                array('answername' => 'Aline', 'image_name' => 'Skirt_Aline.jpg'),
                // array('answername' => 'Skirt Aline 2', 'image_name' => 'Skirt_Aline2.jpg'),
                array('answername' => 'Pencil', 'image_name' => 'Skirt_Pencil.jpg'),
                array('answername' => 'Pleated ', 'image_name' => 'Skirt_Pleated.jpg'),
                array('answername' => 'Straight', 'image_name' => 'Skirt_Straight.jpg'),
                array('answername' => 'I don\'t wear skirts/dresses', 'image_name' => '0_Icon_I_don_t_wear_jewellery.webp', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> skirt lengths you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_76',
            'answer' => array(
                // array('answername' => 'Skirt Knee', 'image_name' => 'Skirt_Knee.jpg'),
                array('answername' => 'Knee', 'image_name' => 'Skirt_Knee2.jpg'),
                // array('answername' => 'Skirt Knee 3', 'image_name' => 'Skirt_Knee3.jpg'),
                array('answername' => 'Maxi', 'image_name' => 'Skirt_Maxi.jpg'),
                // array('answername' => 'Skirt Maxi 2', 'image_name' => 'Skirt_Maxi2.jpg'),
                array('answername' => 'Midi', 'image_name' => 'Skirt_Midi.jpg'),
                // array('answername' => 'Skirt Midi 2', 'image_name' => 'Skirt_Midi2.jpg'),
                array('answername' => 'Mini', 'image_name' => 'Skirt_Mini.jpg'),
                // array('answername' => 'Skirt Mini 2', 'image_name' => 'Skirt_Mini2.jpg'),
                // array('answername' => 'Skirt Mini 3', 'image_name' => 'Skirt_Mini3.jpg'),
            ),
        );

        /* $questions_array[] = array(
        'name' => 'Select all skirt styles and lengths you would wear',
        'type' => 'select',
        'anwer_type' => 'img',
        'question_catogary' => $questions_category_id[3],
        'required' => 'Y',
        'section_heading' => $question_name_section[3],
        'multiple_select' => 'Y',
        'fix_rand_id' => 'fix_rand_id_77',
        'answer' => array(
        array('answername' => 'skirt 1', 'image_name' => 'skirt_1.jpg'),
        array('answername' => 'skirt 2', 'image_name' => 'skirt_2.jpg'),
        array('answername' => 'skirt 3', 'image_name' => 'skirt_3.jpg'),
        array('answername' => 'skirt 4', 'image_name' => 'skirt_4.jpg'),
        ),
        );
         */
        $questions_array[] = array(
            'name' => 'Select <b>all</b> neckline types you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_78',
            'answer' => array(
                array('answername' => 'Boat', 'image_name' => 'Boat.jpg'),
                array('answername' => 'High', 'image_name' => 'High.jpg'),
                array('answername' => 'Scoop', 'image_name' => 'Scoop.jpg'),
                array('answername' => 'Square', 'image_name' => 'Square.jpg'),
                array('answername' => 'Sweetheart', 'image_name' => 'Sweetheart.jpg'),
                array('answername' => 'VNeck', 'image_name' => 'VNeck.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> neckline depths you would wear ',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_79',
            'answer' => array(
                array('answername' => 'Collared', 'image_name' => 'Collared.jpg'),
                array('answername' => 'Deep', 'image_name' => 'Deep.jpg'),
                array('answername' => 'High', 'image_name' => '1_High.jpg'),
                array('answername' => 'Narrow', 'image_name' => 'Narrow.jpg'),
                array('answername' => 'Turtle', 'image_name' => 'Turtle.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> sleeve lengths you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_80',
            'answer' => array(
                array('answername' => '3/4 sleeve', 'image_name' => '3_4.jpg'),
                array('answername' => 'Cap sleeve', 'image_name' => 'Cap_sleeve.jpg'),
                // array('answername' => 'Cap Sleeve', 'image_name' => 'CapSleeve.jpg'),
                array('answername' => 'Full sleeve', 'image_name' => '1_Full.jpg'),
                array('answername' => 'Sleeveless', 'image_name' => 'Sleveless.jpg'),
                array('answername' => 'T-shirt sleeve', 'image_name' => 't_shirt_sleeve.webp'),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select <b>all</b> styles of shoes you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_81',
            'answer' => array(
                array('answername' => 'Ankle boots', 'image_name' => 'Ankle_boots.jpg'),
                array('answername' => 'Ballerina', 'image_name' => 'Ballerina.jpg'),
                array('answername' => 'Brogue Oxford', 'image_name' => 'Brogue_Oxford.jpg'),
                array('answername' => 'Fashion sneaker', 'image_name' => 'Fashion_sneaker.jpg'),
                array('answername' => 'Heel Sandal', 'image_name' => 'Heel_Sandal.jpg'),
                array('answername' => 'Knee High Boots', 'image_name' => 'Knee_High_Boots.jpg'),
                array('answername' => 'Loafers', 'image_name' => 'Loafers.jpg'),
                array('answername' => 'Mules', 'image_name' => 'Mules.jpg'),
                array('answername' => 'Platform', 'image_name' => 'Platform.jpg'),
                array('answername' => 'Pump', 'image_name' => 'Pump.jpg'),
                array('answername' => 'Sandal', 'image_name' => 'Sandal.jpg'),
                array('answername' => 'Slingback', 'image_name' => 'Slingback.jpg'),
                array('answername' => 'Wedge', 'image_name' => 'Wedge.jpg'),
                array('answername' => "Don't include shoes in my deliveries", 'image_name' => "0_Icon_I_don_t_wear_jewellery.webp", 'skip_question_id' => $q_b_rand_no),
            ),
        );


        $questions_array[] = array(
            'name' => 'Select <b>all</b> shoe heel heights you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_82',
            'answer' => array(
                array('answername' => 'High heel', 'image_name' => 'women_shoe_high_heel_1.webp'),
                array('answername' => 'Mid heel', 'image_name' => 'women_shoe_mid_heel.webp'),
                array('answername' => 'Low heel', 'image_name' => 'women_shoe_low_heel.webp'),
                array('answername' => 'No heel', 'image_name' => 'women_shoe_no_heel_1.webp'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Would you wear a stiletto heel?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'N',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_83',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No'),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select <b>all</b> jewellery weights and tones you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            /*'answer_id' => 6,*/
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_84',
            'answer' => array(

                // array('answername' => 'Beaded', 'image_name' => 'Beaded.jpg'),
                // array('answername' => 'Fine Slight', 'image_name' => '1_Fine_Slight.jpg'),
                // array('answername' => 'Gold', 'image_name' => 'Gold.jpg'),
                // array('answername' => 'Grey', 'image_name' => '1_Grey.jpg'),
                array('answername' => 'Fine / slight', 'image_name' => 'fine_slight.png'),
                array('answername' => 'Medium', 'image_name' => '2_Medium.jpg'),
                array('answername' => 'Large / statement', 'image_name' => '3_Large.jpg'),
                // array('answername' => 'Pearl', 'image_name' => 'Pearl.jpg'),
                // array('answername' => 'Rose', 'image_name' => 'Rose.jpg'),

                array('answername' => "I don't wear jewellery", 'image_name' => "0_Icon_I_don't_wear_jewellery.webp", 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> jewellery tones you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_85',
            'skip_id' => $q_b_rand_no,
            'answer' => array(
                // array('answername' => '', 'image_name' => 'other.jpg'),
                // array('answername' => '', 'image_name' => 'other.jpg'),
                // array('answername' => '', 'image_name' => 'other.jpg'),
                array('answername' => 'Abstract', 'image_name' => '12_Abstract_Colour.jpg'),
                array('answername' => 'Beaded', 'image_name' => '10_Beaded_Colour.jpg'),
                array('answername' => 'Coloured Stone', 'image_name' => '8_Coloured_Stone.jpg'),
                array('answername' => 'Gold', 'image_name' => '4_Gold.jpg'),
                array('answername' => 'Gun Metal', 'image_name' => '7_Gun_Metal.jpg'),
                array('answername' => 'Pearl', 'image_name' => '9_Pearl.jpg'),
                array('answername' => 'Rose Gold', 'image_name' => '5_Rose_Gold.jpg'),
                array('answername' => 'Silver', 'image_name' => '6_Silverjpg.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Are you ears pieced?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'N',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_86',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you have any sensitivities to metals on your skin?',
            'type' => 'longtext',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_87',
            'skip_id' => $q_b_rand_no,
        );

        $questions_array[] = array(
            'name' => 'Do you have any injuries or physical barriers that may affect you wearing any clothing, shoe styles or accessories?',
            'type' => 'longtext',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_88',
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select <b>all</b> the styles of <b>tops</b> you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_89',
            'answer' => array(
                // array('answername' => 'brand 1', 'image_name' => 'brand_1.jpg'),
                // array('answername' => 'brand 2', 'image_name' => 'brand_2.jpg'),
                // array('answername' => 'brand 3', 'image_name' => 'brand_3.jpg'),
                // array('answername' => 'brand 4', 'image_name' => 'brand_4.jpg'),
                // array('answername' => 'Classic tee', 'image_name' => 'Top_Style_0002_PoloShirt.jpg'),
                // array('answername' => 'Stripe tee', 'image_name' => 'Top_Style_0001_ShortSleeveShirt.jpg'),
                // array('answername' => 'Graphic tee', 'image_name' => 'Top_Style_0000_StripeTee_ChangeToGreyScale.jpg'),
                // array('answername' => 'Long sleeve tee', 'image_name' => 'Top_Style_0003_LongSleeve.jpg'),
                // array('answername' => 'Short sleeve shirt', 'image_name' => 'Top_Style_0004_GraphicTee.jpg'),
                // array('answername' => 'Smart casual dress shirt', 'image_name' => 'Top_Style_0005_Dappr_Mens.jpg'),
                // array('answername' => 'Business dress shirt', 'image_name' => 'Top_Style_0006_Dappr_Mens_copy.jpg'),

                array('answername' => 'Classic tee', 'image_name' => 'Top_Style_0002_PoloShirt.webp' ,'skip_question_id' => $q_b_rand_no),
                array('answername' => 'Stripe tee', 'image_name' => 'Top_Style_0000_StripeTee_ChangeToGreyScale.jpg','skip_question_id' => $q_b_rand_no),
                array('answername' => 'Graphic tee', 'image_name' => 'Top_Style_0004_GraphicTee.jpg' ,'skip_question_id' => $q_b_rand_no),
                array('answername' => 'Long sleeve tee', 'image_name' => 'Top_Style_0003_LongSleeve.jpg','skip_question_id' => $q_b_rand_no),

                array('answername' => 'Polo shirt', 'image_name' => 'man_polo_shirt.webp'),
                array('answername' => 'Short sleeve shirt', 'image_name' => 'Top_Style_0001_ShortSleeveShirt.jpg'),
                array('answername' => 'Smart casual dress shirt', 'image_name' => 'Top_Style_0006_Dappr_Mens_copy.jpg'),
                array('answername' => 'Business dress shirt', 'image_name' => 'Top_Style_0005_Dappr_Mens.jpg'),
                // array('answername' => 'brand 8', 'image_name' => 'Top_Style_0007_Dappr_Mens_copy_7.jpg'),
                // array('answername' => 'brand 9', 'image_name' => 'Top_Style_0008_Dappr_Mens_copy_6.jpg'),
                // array('answername' => 'brand 10','image_name' => 'Top_Style_0009_Dappr_Mens_copy_5.jpg'),
                // array('answername' => 'brand 11','image_name' => 'Top_Style_0010_Dappr_Mens_copy_4.jpg'),
                // array('answername' => 'brand 12','image_name' => 'Top_Style_0011_Dappr_Mens_copy_3.jpg'),
                // array('answername' => 'brand 13','image_name' => 'Top_Style_0012_Dappr_Mens_copy_2.jpg'),
                // array('answername' => 'brand 14','image_name' => 'Top_Style_0013_ClassicTee.jpg'),
                // array('answername' => 'brand 15','image_name' => 'Top_Style_0014_ClassicTee_Option2.jpg'),
                // array('answername' => 'brand 16','image_name' => 'Top_Style_0015_CasualShirt.jpg'),
                // array('answername' => 'brand 17','image_name' => 'Top_Style_0016_BusinessShirt.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select all the styles of <b>collars</b> you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_90',
            'skip_id' => $q_b_rand_no,
            'answer' => array(
                // array('answername' => 'brand 1', 'image_name' => 'brand_1.jpg'),
                // array('answername' => 'brand 2', 'image_name' => 'brand_2.jpg'),
                // array('answername' => 'brand 3', 'image_name' => 'brand_3.jpg'),
                // array('answername' => 'brand 4', 'image_name' => 'brand_4.jpg'),
                array('answername' =>  'Banded / Mandarin','image_name' => 'Collar_Types_0014_Banded.jpg'),
                array('answername' => 'Button down', 'image_name' => 'Collar_Types_0003_Dappr_Mens.jpg'),
                array('answername' => 'Classic','image_name' => 'Collar_Types_0012_Blue_Classic.jpg'),
                array('answername' => 'Cutaway', 'image_name' => 'Collar_Types_0002_Extreme_cut_away.jpg'),
                array('answername' => 'Contrast','image_name' => 'Collar_Types_0009_Contrast.jpg'),
                array('answername' => 'Spread','image_name' => 'Collar_Types_0010_Blue_Spread_2.jpg'),
                array('answername' => 'Straight', 'image_name' => 'Collar_Types_0000_Straight.jpg'),
                // array('answername' => 'brand 2', 'image_name' => 'Collar_Types_0001_Screen_Shot.jpg'),

                // array('answername' => 'brand 5', 'image_name' => 'Collar_Types_0004_Dappr_Mens_copy.jpg'),
                // array('answername' => 'brand 6', 'image_name' => 'Collar_Types_0005_Dappr_Mens_copy_2.jpg'),
                // array('answername' => 'brand 7', 'image_name' => 'Collar_Types_0006_Dappr_Mens_(3).jpg'),
                // array('answername' => 'brand 8', 'image_name' => 'Collar_Types_0007_Dappr_Mens_(2).jpg'),
                // array('answername' => 'brand 9', 'image_name' => 'Collar_Types_0008_Dappr_Mens_(1).jpg'),

                // array('answername' => 'brand 12','image_name' => 'Collar_Types_0011_Blue_Cut_Away.jpg'),
                // array('answername' => 'brand 14','image_name' => 'Collar_Types_0013_Blue_Button_Down.jpg'),
                // array('answername' => 'brand 16','image_name' => 'brand_4.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> the styles of <b>outerwear</b> you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'multiple_select' => 'Y',
            'fix_rand_id' => 'fix_rand_id_91',
            'answer' => array(
                // array('answername' => 'brand 1', 'image_name' => 'brand_1.jpg'),
                // array('answername' => 'brand 2', 'image_name' => 'brand_2.jpg'),
                // array('answername' => 'brand 3', 'image_name' => 'brand_3.jpg'),
                // array('answername' => 'brand 4', 'image_name' => 'brand_4.jpg'),

                array('answername' => 'Fine knit sweater', 'image_name' => 'Outerwear_0003_Fine_Knit.jpg'),
                array('answername' => 'Heavy knit sweater', 'image_name' => 'Outerwear_0002_Heavy_Knit.jpg'),
                array('answername' => 'Cardigan','image_name' => 'Outerwear_0010_Dappr_Mens_(2).jpg'),
                array('answername' => 'Roll neck sweater', 'image_name' => 'Outerwear_0001_RollNeck.jpg'),
                array('answername' => 'Blazer', 'image_name' => 'Outerwear_0008_Dappr_Mens_(5).jpg'),
                array('answername' => 'Sports jacket', 'image_name' => 'Outerwear_0000_Sport.jpg'),
                array('answername' => 'Casual jacket', 'image_name' => 'Outerwear_0007_Dappr_Mens_(6).jpg'),
                array('answername' => 'Coat', 'image_name' => 'Outerwear_0006_Dappr_Mens_(7).jpg'),
                // array('answername' => 'brand 5', 'image_name' => 'Outerwear_0004_Dappr_Mens.jpg'),
                // array('answername' => 'brand 6', 'image_name' => 'Outerwear_0005_Dappr_Mens_copy.jpg'),
                // array('answername' => 'brand 10','image_name' => 'Outerwear_0009_Dappr_Mens_(3).jpg'),
                // array('answername' => 'brand 12','image_name' => 'Outerwear_0011_Dappr_Mens_(1).jpg'),
                // array('answername' => 'brand 13','image_name' => 'Outerwear_0012_Coat.jpg'),
                // array('answername' => 'brand 14','image_name' => 'Outerwear_0013_CasualJacket.jpg'),
                // array('answername' => 'brand 15','image_name' => 'Outerwear_0014_Cardigan.jpg'),
                // array('answername' => 'brand 16','image_name' => 'Outerwear_0015_Blazer.jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Choose <b>all</b> the styles of <b>pants</b> you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_92',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Chino', 'image_name' => 'Chino.jpg'),
                array('answername' => 'Dress pant', 'image_name' => 'Dress_Pant.jpg'),
                array('answername' => 'Denim jeans', 'image_name' => 'Jeans.jpg'),
                array('answername' => 'Short', 'image_name' => 'Shorts.jpg'),
            ),
        );
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Do you wear suits?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_93',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> styles of <b>suits</b> that you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_94',
            'multiple_select' => 'Y',
            'skip_id' => $q_b_rand_no,
            'answer' => array(
                array('answername' => 'Single breasted', 'image_name' => 'Suiting_0007_Dappr_Mens_copy.jpg'),
                array('answername' => 'Double breasted', 'image_name' => 'Suiting_0005_DoubleBreasted2.jpg'),
                array('answername' => '2 piece suit', 'image_name' => 'Suiting_0000_2Piece.jpg'),
                array('answername' => '3 piece suit', 'image_name' => 'Suiting_0011_Dappr_Mens_(5).jpg'),
                array('answername' => 'Statement fabric', 'image_name' => 'Suiting_0010_Dappr_Mens_(6).jpg'),
                array('answername' => 'Matte fabric', 'image_name' => 'Suiting_0009_Dappr_Mens_(7).jpg'),
                array('answername' => 'Subtle print', 'image_name' => 'Suiting_0008_Dappr_Mens_(8).jpg'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> styles of <b>shoes</b> that you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_95',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Dress shoe - lace up', 'image_name' => 'Shoes_0002_DressShoe_LaceUp_NotScreenShot.jpg'),
                array('answername' => 'Dress shoe - buckle', 'image_name' => 'Shoes_0003_DressShoe_Buckle_NotScreenShot.jpg'),
                array('answername' => 'Dress boot', 'image_name' => 'Shoes_0004_DressBoot.jpg'),
                array('answername' => 'Casual boot', 'image_name' => 'Shoes_0005_Dappr_Mens_(7).jpg'),
                array('answername' => 'Dress sneaker', 'image_name' => 'Shoes_0000_Sneaker.jpg'),
                array('answername' => 'Boat shoe','image_name' => 'Shoes_0012_Boat.jpg'),
                array('answername' => 'Slip on / loafer', 'image_name' => 'Shoes_0001_Loafer.jpg'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y','image_name' => 'other.webp'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select <b>all</b> the <b>accessories</b> you would wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_96',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Belt', 'image_name' => 'Accessories_0010_Dappr_Mens_(9).jpg'),
                array('answername' => 'Cuff links', 'image_name' => 'Accessories_0012_Dappr_Mens_(7).jpg'),
                array('answername' => 'Hat', 'image_name' => 'Accessories_0013_Dappr_Mens_(6).jpg'),
                array('answername' => 'Scarf', 'image_name' => 'Accessories_0016_Dappr_Mens_(2).jpg'),
                array('answername' => 'Tie', 'image_name' => 'Accessories_0002_Tie.jpg'),
                array('answername' => 'Tie bar', 'image_name' => 'Accessories_0008_Dappr_Mens.jpg'),
                array('answername' => 'Pocket square', 'image_name' => 'Accessories_0003_Layer_1.jpg'),
                array('answername' => 'Lapel pin', 'image_name' => 'Accessories_0006_LapelPin.jpg'),
                array('answername' => 'Bag', 'image_name' => 'Accessories_0022_Backpack.jpg'),
                array('answername' => 'Briefcase', 'image_name' => 'Accessories_0020_Briefcase_Option2.jpg'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y','image_name' => 'other.webp'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you have any injuries or physical barriers that may affect you wearing any clothing, shoe styles or accessories?',
            'type' => 'longtext',
            'anwer_type' => 'text',
            'question_catogary' => $questions_category_id[4],
            'reuired' => 'Y',
            'section_heading' => $question_name_section[3],
            'fix_rand_id' => 'fix_rand_id_97',
        );

        // ------------------------------------------------------------------------------------------------------
        // -------------------------------------COLOUR & FABRIC---------------------------------------------------
        // $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Select colours you <u>won\'t</u> wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_98',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Burgundy', 'image_name' => 'Colour_Swatches_0012_Burgundy.jpg'),
                array('answername' => 'Brown', 'image_name' => 'Colour_Swatches_0013_Brown.jpg'),
                array('answername' => 'Blue', 'image_name' => 'Colour_Swatches_0014_Blue.jpg'),
                array('answername' => 'Black', 'image_name' => 'Colour_Swatches_0015_Black.jpg'),
                array('answername' => 'Beige', 'image_name' => 'Colour_Swatches_0016_Beige.jpg'),
                array('answername' => 'Grey', 'image_name' => 'Colour_Swatches_0010_Grey.jpg'),
                array('answername' => 'Green', 'image_name' => 'Colour_Swatches_0011_Green.jpg'),
                array('answername' => 'Metalic', 'image_name' => 'Colour_Swatches_0009_Metallic.jpg'),
                array('answername' => 'Navy', 'image_name' => 'Colour_Swatches_0008_Navy.jpg'),
                array('answername' => 'Orange', 'image_name' => 'Colour_Swatches_0007_Orange.jpg'),
                array('answername' => 'Purple', 'image_name' => 'Colour_Swatches_0005_Purple.jpg'),
                array('answername' => 'Pink', 'image_name' => 'Colour_Swatches_0006_Pink.jpg'),
                array('answername' => 'Red', 'image_name' => 'Colour_Swatches_0004_Red.jpg'),
                array('answername' => 'Teal', 'image_name' => 'Colour_Swatches_0002_Teal.jpg'),
                array('answername' => 'Tan', 'image_name' => 'Colour_Swatches_0003_Tan.jpg'),
                array('answername' => 'White', 'image_name' => 'white.jpg'),
                array('answername' => 'Yellow', 'image_name' => 'Colour_Swatches_0000_Yellow.jpg'),
                array('answername' => 'I like all colours', 'image_name' => 'men_I_like_all_pattern.webp', 'skip_automatic_class' => 'product_box_single_select'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select patterns you <u>won\'t</u> wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_99',
            'multiple_select' => 'Y',

            'answer' => array(

                array('answername' => 'Animal Print', 'image_name' => 'animal_black_white.webp'),
                array('answername' => 'Abstract', 'image_name' => 'Fabric_Patterns_0022_Abstract.jpg'),
                array('answername' => 'Critter Insect', 'image_name' => 'Fabric_Patterns_0000_xCritter_Insect.jpg'),
                array('answername' => 'Plaid', 'image_name' => 'Fabric_Patterns_0006_Plaid.jpg'),
                array('answername' => 'Paisley', 'image_name' => 'Fabric_Patterns_0009_Paisley.jpg'),
                array('answername' => 'Stripes', 'image_name' => 'Fabric_Patterns_0005_Stripes.jpg'),
                array('answername' => 'Floral', 'image_name' => 'Fabric_Patterns_0001_Womens_Floral.jpg'),
                array('answername' => 'Polkadots', 'image_name' => 'polka_dots.webp'),
                array('answername' => 'I like all patterns', 'image_name' => 'men_I_like_all_pattern.webp' , 'skip_automatic_class' => 'product_box_single_select'),
                array('answername' => 'I don\'t like any patterns', 'image_name' => 'i_don\'t_like_any_patterns.webp' , 'skip_automatic_class' => 'product_box_single_select'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Do you find your natural body temperature runs',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_100',
            'multiple_select' => 'N',
            'answer' => array(
                array('answername' => 'Hot'),
                array('answername' => 'Cold'),
                array('answername' => 'Neither'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How important is fabric breathability to you?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_101',
            'multiple_select' => 'N',
            'answer' => array(
                array('answername' => 'Important '),
                array('answername' => 'Somewhat important'),
                array('answername' => 'Doesn\'t bother me'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select fabrics you want us to avoid',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_102',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Faux Fur'),
                array('answername' => 'Leather'),
                array('answername' => 'Linen'),
                array('answername' => 'Polyester'),
                array('answername' => 'Silk'),
                array('answername' => 'Wool'),
                array('answername' => 'I wear all fabric types'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select colours you <u>won\'t</u> wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_103',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Burgundy', 'image_name' => 'Colour_Swatches_0012_Burgundy.jpg'),
                array('answername' => 'Brown', 'image_name' => 'Colour_Swatches_0013_Brown.jpg'),
                array('answername' => 'Blue', 'image_name' => 'Colour_Swatches_0014_Blue.jpg'),
                array('answername' => 'Black', 'image_name' => 'Colour_Swatches_0015_Black.jpg'),
                array('answername' => 'Beige', 'image_name' => 'Colour_Swatches_0016_Beige.jpg'),
                array('answername' => 'Grey', 'image_name' => 'Colour_Swatches_0010_Grey.jpg'),
                array('answername' => 'Green', 'image_name' => 'Colour_Swatches_0011_Green.jpg'),
                array('answername' => 'Metalic', 'image_name' => 'Colour_Swatches_0009_Metallic.jpg'),
                array('answername' => 'Navy', 'image_name' => 'Colour_Swatches_0008_Navy.jpg'),
                array('answername' => 'Orange', 'image_name' => 'Colour_Swatches_0007_Orange.jpg'),
                array('answername' => 'Purple', 'image_name' => 'Colour_Swatches_0005_Purple.jpg'),
                array('answername' => 'Pink', 'image_name' => 'Colour_Swatches_0006_Pink.jpg'),
                array('answername' => 'Red', 'image_name' => 'Colour_Swatches_0004_Red.jpg'),
                array('answername' => 'Teal', 'image_name' => 'Colour_Swatches_0002_Teal.jpg'),
                array('answername' => 'Tan', 'image_name' => 'Colour_Swatches_0003_Tan.jpg'),
                array('answername' => 'White', 'image_name' => 'white.jpg'),
                array('answername' => 'Yellow', 'image_name' => 'Colour_Swatches_0000_Yellow.jpg'),
                array('answername' => 'I like all colours', 'image_name' => 'men_I_like_all_pattern.webp', 'skip_automatic_class' => 'product_box_single_select'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select patterns you <u>won\'t</u> wear',
            'type' => 'select',
            'anwer_type' => 'img',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_104',
            'multiple_select' => 'Y',
            'answer' => array(
                array('answername' => 'Abstract', 'image_name' => 'men_abstract_pattern.png'),
                array('answername' => 'Birdseye', 'image_name' => 'men_birdseye_pattern.png'),
                array('answername' => 'Dots', 'image_name' => 'men_dots_pattern.png'),
                array('answername' => 'Floral', 'image_name' => 'men_floral_pattern.png'),
                array('answername' => 'Gingham', 'image_name' => 'men_gingham_pattern.png'),
                array('answername' => 'Grid', 'image_name' => 'men_grid_pattern.png'),
                array('answername' => 'Herringbone', 'image_name' => 'men_herringbone_pattern.png'),
                array('answername' => 'Insect', 'image_name' => 'men_insect_pattern.png'),
                array('answername' => 'Matte', 'image_name' => 'men_matte_pattern.png'),
                array('answername' => 'Paisley', 'image_name' => 'men_paisley_pattern.png'),
                array('answername' => 'Pinstripe', 'image_name' => 'men_pinstripe_pattern.png'),
                array('answername' => 'Plaid', 'image_name' => 'men_plaid_pattern.png'),
                array('answername' => 'Tartan', 'image_name' => 'men_tartan_pattern.png'),
                array('answername' => 'Tattersall', 'image_name' => 'men_tattersall_pattern.png'),
                array('answername' => 'Windowpane', 'image_name' => 'men_windowpane_pattern.png'),
                array('answername' => 'I like all patterns', 'image_name' => 'men_I_like_all_pattern.webp', 'skip_automatic_class' => 'product_box_single_select'),
                array('answername' => 'I don\'t like any patterns', 'image_name' => 'i_don\'t_like_any_patterns.webp', 'skip_automatic_class' => 'product_box_single_select'),

            ),
        );

        $questions_array[] = array(
            'name' => 'Do you find your natural body temperature runs',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_105',
            'answer' => array(
                array('answername' => 'Hot'),
                array('answername' => 'Cold'),
                array('answername' => 'Neither'),
            ),
        );

        $questions_array[] = array(
            'name' => 'How important is fabric breathability to you?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_106',
            'answer' => array(
                array('answername' => 'Important '),
                array('answername' => 'Somewhat important'),
                array('answername' => 'Doesn\'t bother me'),
            ),
        );

        $questions_array[] = array(
            'name' => 'Select fabrics you want us to avoid',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[4],
            'fix_rand_id' => 'fix_rand_id_107',
            'multiple_select' => 'Y',
            'answer' => array(
                // array('answername' => 'Faux Fur'),
                array('answername' => 'Leather'),
                array('answername' => 'Linen'),
                array('answername' => 'Polyester'),
                array('answername' => 'Silk blend'),
                array('answername' => 'Tweed'),
                array('answername' => 'Wool'),
                array('answername' => 'I wear all fabric types'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y'),
            ),
        );

        // ---------------------------------------------BUDGET-------------------------------------------------------

        /*$questions_array[] = array(
        'name' => 'How often would you purchase a new:',
        'type' => 'select',
        'anwer_type' => '',
        'fix_rand_id' => 'fix_rand_id_108',
        'question_catogary' => $questions_category_id[3],
        'required' => 'Y',
        'section_heading' => $question_name_section[6],
        'multiple_select' => 'N',
        'options' => array(
        'Never',
        'Once a year',
        'Once every 6 months',
        'Once a quarter',
        'Once a month',
        'Multiple times a month OR Monthly',
        'Quarterly',
        'Twice a year',
        'Yearly',
        ),

        'answer' => array(
        array('answername' => 'Tops / Shirt'),
        array('answername' => 'Jacket / blazer'),
        array('answername' => 'Trousers / skirts'),
        array('answername' => 'Shoes'),
        array('answername' => 'Costume jewellery'),
        array('answername' => 'Investment jewellery'),
        array('answername' => 'Belt'),
        array('answername' => 'Scarf'),
        array('answername' => 'Bag'),
        ),
        );
        $questions_array[] = array(
        'name' => 'Your budget',
        'type' => 'select',
        'anwer_type' => '',
        'question_catogary' => $questions_category_id[3],
        'required' => 'Y',
        'section_heading' => $question_name_section[6],
        'multiple_select' => 'N',
        'answer' => array(
        array('answername' => 10),
        array('answername' => 100),
        array('answername' => 1000),
        array('answername' => 10000),
        array('answername' => 'more'),
        ),
        );
         */
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            // 'name' => 'Blouse / Shirt Price',
            'name' => 'How much would you typically spend on a <b>blouse or shirt</b> ?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_109',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$200 - $250', 'value' => 250),
                array('answername' => '$250 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>blouse or shirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_110',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>jacket or blazer</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_111',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300 - $400', 'value' => 400),
                array('answername' => '$400+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>jacket or blazer</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_112',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on <b>trousers or skirts</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_113',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$250 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>trouser or skirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_114',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a pair of <b>shoes</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_115',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new pair of <b>shoes</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_116',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // ------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include <b>costume jewellery</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_117',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on <b>costume jewellery?</b>',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_118',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new piece of <b>costume jewellery</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_119',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // --------------------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include <b>investment or fine jewellery</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'q_type' => 'budget_calculate_depend_on_ans',
            'section_heading' => $question_name_section[5],
            'fix_rand_id' => 'fix_rand_id_120',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            // 'name' => 'Fine Jewelery',
            'name' => 'How much would you typically spend on <b>investment jewellery pieces</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_121',
            'answer' => array(
                array('answername' => 'Under $200', 'value' => 200),
                array('answername' => '$200 - $250', 'value' => 250),
                array('answername' => '$250 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>investment jewellery piece</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_122',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // -----------------------------------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            // 'name' => '<b>Accessories</b> need to be in bold text.',
            'name' => 'Would you like us to include <b>accessories</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_123',
            'description' => 'Eg. Belts, scarves & hats',

            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on <b>accessories</b>?',
            // 'name' => 'Accessories',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_124',
            'description' => 'Eg. Belts, scarves & hats',

            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase new <b>accessories</b>?',
            // 'name' => 'What is Frequency would you purchase a new Fine Accessories:',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_125',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // -----------------------------------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include bag(s)?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_126',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>bag</b>?',
            // 'name' => 'Bags',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_127',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>bag</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_128',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // ----------------------------------------------------------------------------------------------------------

        /*$questions_array[] = array(
        'name' => 'How often would you purchase a new:',
        'type' => 'select',
        'anwer_type' => '',
        'question_catogary' => $questions_category_id[4],
        'required' => 'Y',
        'section_heading' => $question_name_section[6],
        'options' => array(

        'Never',
        'Once a year',
        'Once every 6 months',
        'Once a quarter',
        'Once a month',
        'Multiple times a month OR Monthly',
        'Quarterly',
        'Twice a year',
        'Yearly',
        ),
        'answer' => array(
        array('answername' => 'Tees / polos'),
        array('answername' => 'Jeans / trousers'),
        array('answername' => 'Jackets / Blazers'),
        array('answername' => 'Coat'),
        array('answername' => 'Knit / Sweater'),
        array('answername' => 'Suiting (if the selected above)'),
        array('answername' => 'Shoes'),
        array('answername' => 'Belt'),
        array('answername' => 'Scarf'),
        array('answername' => 'Tie'),
        array('answername' => 'Bag'),
        ),
        );

        $questions_array[] = array(
        'name' => 'Your budget',
        'type' => 'select',
        'anwer_type' => '',
        'question_catogary' => $questions_category_id[4],
        'required' => 'Y',
        'section_heading' => $question_name_section[6],
        'answer' => array(
        array('answername' => 10),
        array('answername' => 100),
        array('answername' => 1000),
        array('answername' => 10000),
        array('answername' => 'more'),
        ),
        );
         */
        // -------------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>shirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_129',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>shirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_130',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>t-shirt or polo shirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_131',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 +', 'value' => 250),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>t-shirt or polo shirt</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_132',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a pair of <b>jeans or trousers</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_133',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new pair of <b>jeans or trousers</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_134',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>knit or sweater</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_135',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300 - $400', 'value' => 400),
                array('answername' => '$400+', 'value' => 600),
            ),
        );

        $questions_array[] = array(

            'name' => 'How often do you typically purchase a new <b>knit or sweater</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_136',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>jacket or blazer</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_137',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300 - $400', 'value' => 400),
                array('answername' => '$400 - $500', 'value' => 500),
                array('answername' => '$500 - $700', 'value' => 700),
                array('answername' => '$700+', 'value' => 900),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>jacket or blazer</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_138',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        // ------------------------------------------------------
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include suiting?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_139',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>suit</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_140',
            'answer' => array(
                array('answername' => 'Under $300', 'value' => 300),
                array('answername' => '$300 - $400', 'value' => 400),
                array('answername' => '$400 - $600', 'value' => 600),
                array('answername' => '$600 - $800', 'value' => 800),
                array('answername' => '$800 - $1000', 'value' => 1000),
                array('answername' => '$1000+', 'value' => 1500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>suit</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_141',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'How much would you typically spend on a pair of <b>shoes</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_142',
            'answer' => array(
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300 - $400', 'value' => 400),
                array('answername' => '$400+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new pair of <b>shoes</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_143',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include <b>accessories</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_144',
            'description' => 'Eg. Belts, scarves & hats',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on <b>accessories</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_145',
            'answer' => array(
                array('answername' => 'Under $50', 'value' => 50),
                array('answername' => '$50 - $100', 'value' => 100),
                array('answername' => '$100 - $150', 'value' => 150),
                array('answername' => '$150 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase new <b>accessories</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_146',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Would you like us to include bags & briefcases?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'q_type' => 'budget_calculate_depend_on_ans',
            'fix_rand_id' => 'fix_rand_id_147',
            'answer' => array(
                array('answername' => 'Yes'),
                array('answername' => 'No', 'skip_question_id' => $q_b_rand_no),
            ),
        );

        $questions_array[] = array(
            'name' => 'How much would you typically spend on a <b>bag</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_148',
            'answer' => array(
                array('answername' => 'Under $100', 'value' => 100),
                array('answername' => '$100 - $200', 'value' => 200),
                array('answername' => '$200 - $300', 'value' => 300),
                array('answername' => '$300+', 'value' => 500),
            ),
        );

        $questions_array[] = array(
            'name' => 'How often do you typically purchase a new <b>bag</b>?',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_q',
            'q_belong_id' => 'QUESTION_ID',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_149',
            'answer' => array(
                array('answername' => 'Monthly (12 items per year)', 'value' => 12),
                array('answername' => 'Bi-monthly (6 items per year)', 'value' => 6),
                array('answername' => 'Quarterly (4 items per year)', 'value' => 4),
                array('answername' => 'Half yearly (2 items per year)', 'value' => 2),
                array('answername' => 'Yearly (1 item per year)', 'value' => 1),
            ),
        );

        $questions_array[] = array(
            'name' => 'Is there anything you would NEVER want to receive from DAPPR',
            'type' => 'select',
            'anwer_type' => ' ',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'Y',
            'q_type' => 'budget_calculate_price_show',
            'fix_rand_id' => 'fix_rand_id_150',
            'answer' => array(
                array('answername' => 'Bags'),
                array('answername' => 'Belts'),
                array('answername' => 'Blazers & Jackets'),
                array('answername' => 'Coats'),
                array('answername' => 'Cufflinks'),
                array('answername' => 'Jeans'),
                array('answername' => 'Pants / Trousers'),
                array('answername' => 'Pocket square'),
                array('answername' => 'Scarves'),
                array('answername' => 'Shirts'),
                array('answername' => 'Shoes'),
                array('answername' => 'Shorts'),
                array('answername' => 'Sweaters / Knitwear'),
                array('answername' => 'Ties'),
                array('answername' => 'T-shirts'),
                array('answername' => 'I\'m open to what DAPPR thinks'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y'),
            ),
        );

        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $q_b_rand_no_ans = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Are you happy to spend a maximum $--- per quarter ',
            'type' => 'select',
            'anwer_type' => 'price',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_price_update',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_151',
            'description' => "Just a reminder, you'll be receiving <b>5 items every 3 months</b>. Based on your spend and frequency of each clothing category we have been able to calculate an average quarterly spend that's the number above.  We'll stick to this budget every quarter when selecting your pieces.",
            'answer' => array(
                array('answername' => 'Yes', 'skip_question_id' => $q_b_rand_no_ans),
                array('answername' => 'No'),

            ),
        );

        $questions_array[] = array(
            'name' => 'If no, what are you happy to spend per quarter on items?',
            'type' => 'text',
            'anwer_type' => 'price',
            'question_catogary' => $questions_category_id[4],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'skip_id' => $q_b_rand_no_ans,
            'q_type' => 'budget_calculate_manual_price_update',
            'fix_rand_id' => 'fix_rand_id_152',
        );

        $questions_array[] = array(
            'name' => 'Is there anything else you\'d like to tell your stylist before we proceed?',
            'type' => 'text',
            'anwer_type' => 'text',
            'question_catogary' => $questions_category_id[4],
            'required' => 'N',
            'section_heading' => $question_name_section[5],
            'fix_rand_id' => 'fix_rand_id_153',

        );

        $questions_array[] = array(
            'name' => 'Is there anything you would NEVER want to receive from DAPPR',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'Y',
            'q_type' => 'budget_calculate_price_show',
            'fix_rand_id' => 'fix_rand_id_154',
            'answer' => array(
                array('answername' => 'Bags'),
                array('answername' => 'Belts'),
                array('answername' => 'Blazers & Jackets'),
                array('answername' => 'Coats'),
                array('answername' => 'Dresses'),
                array('answername' => 'Jeans'),
                array('answername' => 'Jewellery'),
                array('answername' => 'Knitwear'),
                array('answername' => 'Scarves'),
                array('answername' => 'Shoes'),
                array('answername' => 'Shorts'),
                array('answername' => 'Skirts'),
                array('answername' => 'Trousers'),
                array('answername' => 'Tops'),
                array('answername' => 'I\'m open to what DAPPR thinks'),
                array('answername' => 'Other', 'has_logn_text_ans' => 'Y'),
            ),
        );
        $q_b_rand_no = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $q_b_rand_no_ans = date('dmy_his') . '_' . rand(10, 100) . '_' . rand(10, 100);
        $questions_array[] = array(
            'name' => 'Are you happy to spend a maximum $--- per quarter ',
            'type' => 'select',
            'anwer_type' => '',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'q_type' => 'budget_calculate_price_update',
            'skip_id' => $q_b_rand_no,
            'fix_rand_id' => 'fix_rand_id_155',
            'description' => "Just a reminder, you'll be receiving <b>5 items every 3 months</b>. Based on your spend and frequency of each clothing category we have been able to calculate an average quarterly spend that's the number above. We'll stick to this budget every quarter when selecting your pieces.",
            'answer' => array(
                array('answername' => 'Yes', 'skip_question_id' => $q_b_rand_no_ans),
                array('answername' => 'No'),
            ),
        );

        $questions_array[] = array(
            'name' => 'If no, what are you happy to spend per quarter on items?',
            'type' => 'text',
            'anwer_type' => 'price',
            'question_catogary' => $questions_category_id[3],
            'required' => 'Y',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'skip_id' => $q_b_rand_no_ans,
            'fix_rand_id' => 'fix_rand_id_156',
            'q_type' => 'budget_calculate_manual_price_update',
        );

        $questions_array[] = array(
            'name' => 'Is there anything else you\'d like to tell your stylist before we proceed?',
            'type' => 'longtext',
            'anwer_type' => 'text',
            'question_catogary' => $questions_category_id[3],
            'required' => 'N',
            'section_heading' => $question_name_section[5],
            'multiple_select' => 'N',
            'fix_rand_id' => 'fix_rand_id_157',
        );

        // print_r($questions_array);
        // die;

        $previous_question_id = 0;
        foreach ($questions_array as $value) {
            $q_belong_id = 0;
            if (isset($value['q_belong_id'])) {
                $value['q_belong_id'] = $previous_question_id;

            }
            $question = stylistQuestions::create(
                [
                    'name' => isset($value['name']) ? $value['name'] : '',
                    'type' => isset($value['type']) ? $value['type'] : '',
                    'question_catogary' => isset($value['question_catogary']) ? $value['question_catogary'] : '',
                    'anwer_type' => isset($value['anwer_type']) ? $value['anwer_type'] : '',
                    'section_heading' => isset($value['section_heading']) ? $value['section_heading'] : '',
                    'required' => isset($value['required']) ? $value['required'] : '',
                    'depending_question' => isset($value['depending_question']) ? $value['depending_question'] : '',
                    'order' => isset($value['order']) ? $value['order'] : '',
                    'multiple_select' => isset($value['multiple_select']) ? $value['multiple_select'] : '',
                    'depend_on_ans' => isset($value['depend_on_ans']) ? $value['depend_on_ans'] : '',

                    'description' => isset($value['description']) ? $value['description'] : '',
                    'q_belong_id' => isset($value['q_belong_id']) ? $value['q_belong_id'] : '',
                    'skip_id' => isset($value['skip_id']) ? $value['skip_id'] : '',
                    'hide_answer_label' => isset($value['hide_answer_label']) ? $value['hide_answer_label'] : '',
                    'multiple_answer_limit' => isset($value['multiple_answer_limit']) ? $value['multiple_answer_limit'] : '',
                    'q_type' => isset($value['q_type']) ? $value['q_type'] : '',
                    'fix_rand_id' => isset($value['fix_rand_id']) ? $value['fix_rand_id'] : '',
                    'tag_status' => isset($value['tag_status']) ? $value['tag_status'] : '',
                    'tag_category_id' => isset($value['tag_category_id']) ? $value['tag_category_id'] : '',
                ]
            );

            $previous_question_id = $question->id;
            if (isset($value['answer'])) {
                foreach ($value['answer'] as $ans_value) {
                    stylistQuestionsAnswers::create(
                        [
                            'name' => isset($ans_value['answername']) ? $ans_value['answername'] : '',
                            'image_name' => isset($ans_value['image_name']) ? $ans_value['image_name'] : '',
                            'belong_to' => isset($ans_value['blogn_to']) ? $ans_value['blogn_to'] : '',
                            'question_id' => $question->id,
                            'order' => isset($ans_value['order']) ? $ans_value['order'] : '',
                            'depend_cat_id' => isset($ans_value['depend_cat_id']) ? $ans_value['depend_cat_id'] : '',
                            'tag_id' => isset($ans_value['tag_id']) ? $ans_value['tag_id'] : '',
                            'value' => isset($ans_value['value']) ? $ans_value['value'] : '',
                            'skip_question_id' => isset($ans_value['skip_question_id']) ? $ans_value['skip_question_id'] : '',
                            'has_logn_text_ans' => isset($ans_value['has_logn_text_ans']) ? $ans_value['has_logn_text_ans'] : '',
                            'skip_automatic_class' => isset($ans_value['skip_automatic_class']) ? $ans_value['skip_automatic_class'] : '',
                        ]
                    );
                }
            }
        }
    }
}
