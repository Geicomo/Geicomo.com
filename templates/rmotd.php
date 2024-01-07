RMOTD:
<?php
                //20 possible strings
                $val = rand(1,20);

                switch ($val)
        {
        case 1:
                echo "Powered by Debian! ";
                break;
        case 2:
                echo "Sometimes I dream about cheese... ";
                echo "<audio autoplay><source src='/var/www/html/audio/cheese.mp3' type='audio/mpeg'></audio>";
                break;
        case 3:

                echo "Geicomo? I thought it was spelled- ";
                break;
        case 4:
                echo "Powered by SPAM";
                break;
        case 5:
                echo "This wouldent be here without CynicalDebian";
                break;
        case 6:
                echo "3,124.7 Hours ;)";
                break;
        case 7:
                echo " <a href='https://www.youtube.com/watch?v=j7Ff6izcRCc'>Click Me</a> ";
                break;
        Case 8:
                echo "THE REDLINERUSH!!!";
                break;
        case 9:
                echo "Giant Enemy Spider";
                break;
        case 10:
                echo "Currently at Sea";
                break;
        case 11:
                echo " <marquee direction='right'> weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed</marquee>";
                break;
        case 12:
                echo "Faded than a hoe faded than a hoe faded than a hoe faded than a...";
                break;
        case 13:
                echo "Monkey D. Luffy!!1!";
                break;
        case 14:
                echo "Taking a break;";
                break;
        case 15:
                echo "More secure than club penguin";
		break;
	case 16:
		echo "Geicomo Gamessssssss...";
		break;
        default:
                echo "Tough luck";
                break;
        }
?>
