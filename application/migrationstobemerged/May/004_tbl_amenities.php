<?php
/**
 * Class Migration_Tbl_amenities
 *
 * Auto_increment is added to the table
 *
 * @author Eftakhairul Islam <eftakhairul@gmial.com>
 */
class Migration_Tbl_amenities extends CI_Migration
{

	public function up()
	{
        //Make table empty
        $migrationQuery = "TRUNCATE TABLE `tbl_amenities`";

        //Run the query
		mysql_query($migrationQuery);

        //Insert query
        $migrationQuery = "INSERT INTO tbl_amenities
                                VALUES
                                  (1, 'Air Conditioning', '', 1),
                                  (2, 'Bath', '', 1),
                                  (3, 'BBQ', '', 1),
                                  (4, 'Bicycle', '', 1),
                                  (5, 'Boat Parking', '', 1),
                                  (6, 'Boat/Dinghy', '', 1),
                                  (7, 'Carport', '', 1),
                                  (8, 'Computer', '', 1),
                                  (9, 'CD/Stereo', '', 1),
                                  (10, 'Child\'s Games/Toys', '', 1),
                                  (11, 'Clothesline', '', 1),
                                  (12, 'Coffee Machine', '', 1),
                                  (13, 'Coffee Plunger', '', 1),
                                  (14, 'Deck Chairs', '', 1),
                                  (15, 'Dishwasher', '', 1),
                                  (16, 'Driveway (Private)', '', 1),
                                  (17, 'Driveway (Shared)', '', 1),
                                  (18, 'Dryer', '', 1),
                                  (19, 'Drying Room', '', 1),
                                  (20, 'DVD Player', '', 1),
                                  (21, 'Electric Blankets - Age:', '', 1),
                                  (22, 'Ensuite - #:', '', 1),
                                  (23, 'Fully Fenced', '', 1),
                                  (24, 'Partially Fenced', '', 1),
                                  (25, 'Fireplace (Gas/Electric)', '', 1),
                                  (26, 'Fireplace (Closed/Pot Belly)', '', 1),
                                  (27, 'Fireplace (Open/Wood)', '', 1),
                                  (28, 'Freeview', '', 1),
                                  (29, 'Freezer', '', 1),
                                  (30, 'Fridge', '', 1),
                                  (31, 'Garage ', '', 1),
                                  (32, 'Private Garden', '', 1),
                                  (33, 'Gym Facilities', '', 1),
                                  (34, 'Hair Dryer', '', 1),
                                  (35, 'Heat Pump', '', 1),
                                  (36, 'Heated Towel Rails', '', 1),
                                  (37, 'Heater (Electric)', '', 1),
                                  (38, 'Heater (Fan)', '', 1),
                                  (39, 'Heater (Gas)', '', 1),
                                  (40, 'Heater (Oil)', '', 1),
                                  (41, 'Heather (Radiator)', '', 1),
                                  (42, 'High Chair ', '', 1),
                                  (43, 'Hot Tub/Spa Pool', '', 1),
                                  (44, 'Hose and Tap', '', 1),
                                  (45, 'iPod Docking Station', '', 1),
                                  (46, 'Internet (Dial Up)', '', 1),
                                  (47, 'Internet (Broadband)', '', 1),
                                  (48, 'Internet (Wireless)', '', 1),
                                  (49, 'Iron', '', 1),
                                  (50, 'Ironing Board', '', 1),
                                  (51, 'Lakefront', '', 1),
                                  (52, 'Laundry', '', 1),
                                  (53, 'Living Room', '', 1),
                                  (54, 'Media Room', '', 1),
                                  (55, 'Microwave', '', 1),
                                  (56, 'Mooring for a Boat', '', 1),
                                  (57, 'Nintendo Wii', '', 1),
                                  (58, 'Office', '', 1),
                                  (59, 'Out Door Fireplace', '', 1),
                                  (60, 'Outdoor Shower', '', 1),
                                  (61, 'Outdoor Table/Chairs', '', 1),
                                  (62, 'Oven','', 1),
                                  (63, 'Parking (Off-Street)', '', 1),
                                  (64, 'Electric Blankets - Age:', '', 1),
                                  (65, 'Ensuite - #:', '', 1),
                                  (66, 'Fully Fenced', '', 1),
                                  (67, 'Partially Fenced', '', 1),
                                  (68, 'Fireplace (Gas/Electric)', '', 1),
                                  (69, 'Fireplace (Closed/Pot Belly)', '', 1),
                                  (70, 'Fireplace (Open/Wood)', '', 1),
                                  (71, 'Freeview', '', 1),
                                  (72, 'Freezer', '', 1),
                                  (73, 'Fridge', '', 1),
                                  (74, 'Garage ', '', 1),
                                  (75, 'Private Garden', '', 1),
                                  (76, 'GParking (On-Street)', '', 1),
                                  (77, 'Phone', '', 1),
                                  (78, 'Playstation', '', 1),
                                  (79, 'Pool/Billiards Table', '', 1),
                                  (80, 'Port-A-Cot', '', 1),
                                  (81, 'Qualmark Rated', '', 1),
                                  (82, 'Sky Digital', '', 1),
                                  (83, 'My Sky', '', 1),
                                  (84, 'Stove/Cookware', '', 1),
                                  (85, 'Study', '', 1),
                                  (86, 'Sundeck', '', 1),
                                  (87, 'Surf Boards', '', 1),
                                  (88, 'Swimming Pool', '', 1),
                                  (89, 'Table Tennis', '', 1),
                                  (90, 'Tennis Court', '', 1),
                                  (91, 'Toastie Maker', '', 1),
                                  (92, 'Toaster', '', 1),
                                  (93, 'TV - Size:', '', 1),
                                  (94, 'Washing Machine', '', 1),
                                  (95, 'Wheelchair Friendly', '', 1),
                                  (96, 'Wood Supplies', '', 1),
                                  (97, 'Xbox', '', 1);";


        //Run the query
		mysql_query($migrationQuery);
    }

	public function down()
    {
    }
}




