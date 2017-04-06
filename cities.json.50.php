<?php

$json_data_1 = '[
  {
    "city": "New York",
    "count": 790156
  },
  {
    "city": "Chicago",
    "count": 436562
  },
  {
    "city": "Washington",
    "count": 268031
  },
  {
    "city": "Houston",
    "count": 247610
  },
  {
    "city": "Boston",
    "count": 228691
  },
  {
    "city": "San Francisco",
    "count": 215133
  },
  {
    "city": "Atlanta",
    "count": 190873
  },
  {
    "city": "Seattle",
    "count": 188320
  },
  {
    "city": "Austin",
    "count": 161674
  },
  {
    "city": "Minneapolis",
    "count": 154197
  }
]';
$json_data_2 = '[
  {
    "city": "Dallas",
    "count": 153737
  },
  {
    "city": "Los Angeles",
    "count": 127411
  },
  {
    "city": "Columbus",
    "count": 121757
  },
  {
    "city": "Charlotte",
    "count": 119828
  },
  {
    "city": "San Diego",
    "count": 119608
  },
  {
    "city": "Denver",
    "count": 119181
  },
  {
    "city": "Indianapolis",
    "count": 107751
  },
  {
    "city": "Phoenix",
    "count": 107398
  },
  {
    "city": "Madison",
    "count": 107063
  },
  {
    "city": "San Jose",
    "count": 107032
  }
]';
$json_data_3 = '[
  {
    "city": "Philadelphia",
    "count": 106952
  },
  {
    "city": "Portland",
    "count": 100212
  },
  {
    "city": "Cleveland",
    "count": 93158
  },
  {
    "city": "Nashville",
    "count": 92325
  },
  {
    "city": "Baltimore",
    "count": 91349
  },
  {
    "city": "Cincinnati",
    "count": 84142
  },
  {
    "city": "Tampa",
    "count": 82723
  },
  {
    "city": "Pittsburgh",
    "count": 80916
  },
  {
    "city": "San Antonio",
    "count": 79560
  },
  {
    "city": "Milwaukee",
    "count": 72235
  }
]';
$json_data_4 = '[
  {
    "city": "Ann Arbor",
    "count": 71156
  },
  {
    "city": "Rochester",
    "count": 69979
  },
  {
    "city": "Miami",
    "count": 69544
  },
  {
    "city": "Arlington",
    "count": 69343
  },
  {
    "city": "Bethesda",
    "count": 69012
  },
  {
    "city": "Irvine",
    "count": 67822
  },
  {
    "city": "St Louis",
    "count": 66965
  },
  {
    "city": "Rockville",
    "count": 66164
  },
  {
    "city": "Columbia",
    "count": 62596
  },
  {
    "city": "Kansas City",
    "count": 61805
  }
]';
$json_data_5 = '[
  {
    "city": "Jacksonville",
    "count": 61767
  },
  {
    "city": "Raleigh",
    "count": 60731
  },
  {
    "city": "Cambridge",
    "count": 60037
  },
  {
    "city": "Las Vegas",
    "count": 59427
  },
  {
    "city": "Memphis",
    "count": 58974
  },
  {
    "city": "Little Rock",
    "count": 58345
  },
  {
    "city": "Morrisville",
    "count": 57847
  },
  {
    "city": "Santa Clara",
    "count": 57390
  },
  {
    "city": "Salt Lake City",
    "count": 57342
  },
  {
    "city": "Louisville",
    "count": 56032
  }
]';

$q = $_GET['q'];

if ($q === 'n') {
  echo $json_data_1;
} else if ($q === 'e') {
  echo $json_data_2;
} else if ($q === 'z') {
  echo $json_data_3;
} else if ($q === 'a') {
  echo $json_data_4;
} else if ($q === 's') {
  echo $json_data_5;
} else {
  echo '{}';
}

