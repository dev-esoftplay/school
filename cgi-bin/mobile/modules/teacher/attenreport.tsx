// withHooks
import { memo } from 'react';
import Lib, { CiCircleOutlined } from '@ant-design/icons';
import lib from '@ant-design/icons';
import Icon from '@ant-design/icons/lib/components/Icon';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibSlidingup, LibSlidingupProperty } from 'esoftplay/cache/lib/slidingup/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import navigation from 'esoftplay/modules/lib/navigation';
import Animated, { useSharedValue, withSpring } from 'react-native-reanimated';
import Svg, { Circle, Rect } from 'react-native-svg';
import { show } from 'esoftplay/modules/lib/toast';
import { useRef } from 'react';
import PieChart from 'react-native-pie-chart'
import React from 'react';
import { ActivityIndicator, Button, FlatList, Image, Platform, Pressable, ScrollView, Text, View } from 'react-native';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';


export interface TeacherAttenreportArgs {

}
export interface TeacherAttenreportProps {

}
function m(props: TeacherAttenreportProps): any {
  const [klsSelected, setKlsSelected] = React.useState(false)
  const dayAttendance = [
    {
      day: 'Senin',
      date: '2024-01-01',
      indicator: 0.9,
      status: 'completed',
      color: 'green'
    },
    {
      day: 'Selasa',
      date: '2024-01-02',
      indicator: 0.7,
      status: 'completed',
      color: 'green'
    },
    {
      day: 'Rabu',
      date: '2024-01-03',
      indicator: 0.0,
      status: 'uncompleted',
      color: 'red'
    },
    {
      day: 'Kamis',
      date: '2024-01-04',
      indicator: 0.0,
      status: 'uncompleted',
      color: 'red'
    },
    {
      day: 'Jumat',
      date: '2024-01-05',
      indicator: 0.8,
      color: 'green'
    }

  ]
  const Absensi = [

    {
      'nama kelas': 'XII IPA 1',
      'jam': '07.00-08.00',
      'jamke': 'jam ke 1 -jam ke 2',
      'jumlah siswa': '30/30',
      'materi': 'Matematika',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 2',
      'jam': '08.00-09.00',
      'jamke': 'jam ke 3 -jam ke 4',
      'materi': 'Fisika',
      'jumlah siswa': '00/30',
      'color': 'red'
    },
    {
      'nama kelas': 'XII IPA 3',
      'jam': '09.00-10.00',
      'jamke': 'jam ke 5 -jam ke 6',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 4',
      'jam': '10.00-11.00',
      'jamke': 'jam ke 7 -jam ke 8',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    },
    {
      'nama kelas': 'XII IPA 5',
      'jam': '11.00-12.00',
      'jamke': 'jam ke 9 -jam ke 10',
      'materi': 'Matematika',
      'jumlah siswa': '30/30',
      'color': 'green'
    }

  ]
  const Bulan = [
    {
      "name": "January",
      "abbreviation": "Jan",
      "number": 1,
      "days": 31
    },
    {
      "name": "February",
      "abbreviation": "Feb",
      "number": 2,
      "days": 28
    },
    {
      "name": "March",
      "abbreviation": "Mar",
      "number": 3,
      "days": 31
    },
    {
      "name": "April",
      "abbreviation": "Apr",
      "number": 4,
      "days": 30
    },
    {
      "name": "May",
      "abbreviation": "May",
      "number": 5,
      "days": 31
    },
    {
      "name": "June",
      "abbreviation": "Jun",
      "number": 6,
      "days": 30
    },
    {
      "name": "July",
      "abbreviation": "Jul",
      "number": 7,
      "days": 31
    },
    {
      "name": "August",
      "abbreviation": "Aug",
      "number": 8,
      "days": 31
    },
    {
      "name": "September",
      "abbreviation": "Sep",
      "number": 9,
      "days": 30
    },
    {
      "name": "October",
      "abbreviation": "Oct",
      "number": 10,
      "days": 31
    },
    {
      "name": "November",
      "abbreviation": "Nov",
      "number": 11,
      "days": 30
    },
    {
      "name": "December",
      "abbreviation": "Dec",
      "number": 12,
      "days": 31
    }
  ]

  let slideup = useRef<LibSlidingup>(null)

  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: "black", shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
    }
    return { elevation: value };
  }
  function shadows(value: number) {
    return {
      elevation: 3, // For Android
      shadowColor: 'black', // For iOS
      shadowOffset: { width: 2, height: 5 },
      shadowOpacity: 0.9,
      shadowRadius: value,
    }
  }



  const progress = useSharedValue(0)

  const BACKGROUND_STROKE_COLOR = '#ffffff'
  const STROKE_COLOR = '#11b81f'
  const R = 30
  const Circle_length = 2 * Math.PI * R
  const height = LibStyle.height
  const width = LibStyle.width

  return (
    <View style={{ flex: 1, backgroundColor: 'white', }}>

      <FlatList data={dayAttendance}
        style={{ height: 'auto', paddingHorizontal: 20 }}
        showsVerticalScrollIndicator={false}
        ListHeaderComponent={

          <View style={{ marginBottom: 20, }}>
            {/* schadule */}
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Laporan Absensi</Text>
            <Pressable

              onPress={() => {
                slideup.current?.show()
                console.log('')
              }}
              style={{ width: LibStyle.width - 45, height: 60, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginTop: 30, ...elevation(7), paddingHorizontal: 20, marginHorizontal: 5 }}>
              <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>
                <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', textAlign: 'center', }}>Filter</Text>
                <LibIcon.Feather name="filter" size={20} color="black" style={{ position: 'absolute', right: 20 }} />
              </View>
            </Pressable>
          </View>

        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {

            const widthAndHeight = 80
            const series = [70, 10, 20,]
            const sliceColor = ['#009b00', '#ffb300', '#ff3c00']

            return (
              <Pressable onPress={() => LibNavigation.navigate('teacher/detailattendreport')} style={{ backgroundColor: item['color'], padding: 10, width: LibStyle.width - 40, paddingHorizontal: 20, borderRadius: 15, opacity: 0.8, ...shadows(3), marginVertical: 10, flexDirection: 'row', height: 120, justifyContent: 'space-between' }}>

                <View style={{ justifyContent: 'space-between' }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item['day']}</Text>
                  <View style={{ height: 30, }} />
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item['date']}</Text>
                </View>

                <View style={{ width: 100, height: 100, justifyContent: 'center', alignItems: 'center',  }}>
                  {/* <PieChart
                    style={{ alignSelf: 'center' }}
                    widthAndHeight={widthAndHeight}
                    series={[70,5,20]}
                    sliceColor={sliceColor}
                    coverRadius={0.45}
                    coverFill={'none'}
                  /> */}

                  <Svg width={100} height={100} style={{ justifyContent: 'center', alignItems: 'center' }}>
                  {/* Lingkaran luar untuk indikator persentase  */}
                    <Circle
                        cx={100 / 2}
                        cy={100 / 2}
                        r={R}
                        fillOpacity={0.8}
                        stroke={BACKGROUND_STROKE_COLOR}
                        strokeWidth={18}
                        fill={'none'}
                        
                    /> 
                  {/* Lingkaran dalam untuk menunjukkan persentase */}
                 <Circle
                    cx={100 / 2}
                    cy={100 / 2}
                    r={R}
                    // strokeOpacity={0.8}
                    stroke={STROKE_COLOR}
                    strokeWidth={12}

                    fill={'none'}
                    // fillOpacity={0.8}
                    strokeDasharray={`${Circle_length}`}
                    strokeDashoffset={Circle_length * (1 - item['indicator'])}
                    strokeLinecap="round"
                  />
                  </Svg>

                  <Text style={{ position: 'absolute', color: 'white' }}>
                    {` ${item['indicator'] * 10}/8`}
                  </Text>
                </View>

              </Pressable>
            )
          }
        } />

      <LibSlidingup ref={slideup}>
        <View style={{ height: 500, backgroundColor: 'white', padding: 10, borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingHorizontal: 20 }}>
          <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20, alignSelf: 'center' }}>Filter Absensi</Text>
          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih Kelas</Text>

          <FlatList data={Absensi}
            style={{ height: 60, marginTop: 20 }}
            keyExtractor={(item, index) => index.toString()}
            horizontal
            showsHorizontalScrollIndicator={false}
            renderItem={
              ({ item, index }) => {
                return (
                  <Pressable onPress={() => { setKlsSelected(true) }}>
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: klsSelected ? 'gray' : 'white' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', alignSelf: 'center' }}>{item['nama kelas']}</Text>
                    </View>
                  </Pressable>
                )
              }}
          />
          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih bulan</Text>
          <FlatList data={Bulan}
            style={{ height: 'auto', marginTop: 20 }}
            keyExtractor={(item, index) => index.toString()}
            horizontal
            showsHorizontalScrollIndicator={false}
            renderItem={
              ({ item, index }) => {
                return (
                  <Pressable onPress={() => { setKlsSelected(true) }}>
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: klsSelected ? 'gray' : 'white' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', alignSelf: 'center' }}>{item['name']}</Text>
                      <View style={{ height: 30 }} />
                    </View>
                  </Pressable>
                )
              }}
          />
          <Pressable onPress={() => { slideup.current?.hide() }} style={{ width: "100%", height: 60, backgroundColor: '#423a3a', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 30, }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>Terapkan</Text>
          </Pressable>
          <View style={{ height: 120 }} />

        </View>

      </LibSlidingup>
    </View>

  )
}
export default memo(m);