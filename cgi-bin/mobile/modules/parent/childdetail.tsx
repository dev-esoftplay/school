// withHooks
import { memo, useEffect, useRef, useState } from 'react';

import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { MaterialIcons, FontAwesome5 } from '@expo/vector-icons';
import React from 'react';
import { FlatList, Image, Linking, Platform, Pressable, Text, TouchableOpacity, View, } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import Svg, { Circle } from 'react-native-svg';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { Feather } from '@expo/vector-icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { LibList } from 'esoftplay/cache/lib/list/import';
import esp from 'esoftplay/esp';
import useSafeState from 'esoftplay/state';


export interface ChildDetailArgs {

}
export interface ChildDetailProps {

}

function m(props: ChildDetailProps): any {
  const allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  const allMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  const allWeeks = ['Week 1', 'Week 2', 'Week 3', 'Week 4'];

  const [selectedDay, setSelectedDay] = useState(allDays[0]);
  const kehadiran = [
    {
      kategori: 'Hadir',
      value: 30,
      color: '#0DBD5E',
    },
    {
      kategori: 'Sakit',
      value: 10,
      color: '#F6C956',
    },
    {
      kategori: 'Izin',
      value: 5,
      color: '#0083FD',
    },
    {
      kategori: 'Alfa',
      value: 5,
      color: '#FF4343',
    },
  ];

  const [selectedMonth, setSelectedMonth] = useState(allMonths[0]);

  const [selectedWeek, setSelectedWeek] = useState(allWeeks[0]);

  const scheduleData = [
    { day: 'Monday', events: ['MATH', 'PHYSICS', 'CHEMISTRY'] },
    { day: 'Tuesday', events: ['HISTORY', 'LITERATURE', 'ENGLISH'] },
    { day: 'Wednesday', events: ['BIOLOGY', 'SPORT', 'LUNCH'] },
    { day: 'Thursday', events: ['COMPUTER', 'MUSIC', 'ART'] },
    { day: 'Friday', events: ['GEOGRAPH', 'LANGUANGE', 'SOCIAL'] },
    { day: 'Saturday', events: ['CLUB ACT', 'SPORT', 'STUDY GROUP'] },
    { day: 'Sunday', events: ['REST DAY'] },
  ];

  const monthFilter = [
    { month: 'January', events: ['Test'] },
    { month: 'February', events: ['Test'] },
    { month: 'March', events: ['Test'] },
    { month: 'April', events: ['Test'] },
    { month: 'May', events: ['Test'] },
    { month: 'June', events: ['Test'] },
    { month: 'July', events: ['Test'] },
    { month: 'August', events: ['Test'] },
    { month: 'September', events: ['Test'] },
    { month: 'October', events: ['Test'] },
    { month: 'November', events: ['Test'] },
    { month: 'December', events: ['Test'] },
  ];

  const weekFilter = [
    { week: 'Week 1', events: ['Test'] },
    { week: 'Week 2', events: ['Test'] },
    { week: 'Week 3', events: ['Test'] },
    { week: 'Week 4', events: ['Test'] },
  ]

  const filteredSchedule = scheduleData.filter(item => item.day === selectedDay);

  function elevation(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: 'black', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 };
    }
    return { elevation: value };
  }

  const filteredMonth = monthFilter.filter(item => item.month === selectedMonth);

  const filteredWeek = weekFilter.filter(item => item.week === selectedWeek);

  let slideup = useRef<LibSlidingup>(null)

  const BACKGROUND_STROKE_COLOR = '#ffffff'
  const STROKE_COLOR = '#11b81f'
  const R = 30
  const Circle_length = 2 * Math.PI * R

  function shadowS(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
    }
    return { elevation: value };
  }

  const allTabs = ['Riwayat Absensi', 'Jadwal Anak'];
  const [selectTab, setSelectTab] = useSafeState(allTabs[0])

  const [ParentStudent, setParentStudent] = useSafeState<any>([])
  const [StudentDetailAttendance, setStudentDetailAttendance] = useSafeState<any>([])
  const [TeacherScheduleClass, setTeacherScheduleClass] = useSafeState<any>([])

  const id: number = 1

  const hitApi = () => { }

  function loadParentStudent() {
    new LibCurl('parent_student', get, (result, msg) => {
      console.log("result parent detail", JSON.stringify(result))
      setParentStudent(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  function loadStudentDetailAttendance() {
    new LibCurl('student_detail_attendance?class_id=' + id + '&student_id=' + id, get, (result, msg) => {
      console.log("result attendance detail", JSON.stringify(result))
      setStudentDetailAttendance(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  function loadTeacherScheduleClass() {
    new LibCurl('teacher_schedule_class?class_id=' + id, get, (result, msg) => {
      // console.log("result schedule detail", JSON.stringify(result))
      setTeacherScheduleClass(result)
    }, (err: any) => {
      console.log("error", err)
    }, 1)
  }

  useEffect(() => {
    loadParentStudent();
    loadStudentDetailAttendance();
    loadTeacherScheduleClass();
  }, []);

  // esp.log({ TeacherScheduleClass });

  const Tabs = () => {
    if (selectTab == allTabs[0]) {
      return (
        <View style={{ flex: 3, padding: 20, alignItems: 'flex-start' }}>

          <View style={{ flexDirection: 'row', marginTop: -10 }}>
            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#0DBD5E', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.hadir}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Hadir</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#F6C956', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.sakit}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Sakit</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#0083FD', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.ijin}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Izin</Text>
            </View>

            <View style={{ height: 80, width: 85, alignItems: 'center', backgroundColor: '#FF4343', justifyContent: 'center', borderRadius: 10, marginRight: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold', color: '#FFFFFF' }}>{StudentDetailAttendance?.attendance_data?.tidak_hadir}</Text>
              <Text style={{ fontSize: 18, fontWeight: 'bold', color: '#FFFFFF' }}>Alfa</Text>
            </View>
          </View>

          <Pressable onPress={() => {
            slideup.current?.show()
          }} style={{ marginTop: 20, backgroundColor: '#FFFFFF', borderRadius: 10, alignItems: 'center', justifyContent: 'center', flexDirection: 'row', ...elevation(4), width: 370, height: 45 }}>
            <FontAwesome5 name='sliders-h' size={20} color='#000000' />
            <Text style={{ fontSize: 15, fontWeight: '500', color: '#000000', marginLeft: 10 }}>Filter</Text>
          </Pressable>

          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 10 }}>Riwayat Absensi</Text>

          {/* <View style={{ width: 100, backgroundColor: 'pink' }}>
            <Text>test riwayat riwayat</Text>
            <LibList
              data={TeacherScheduleClass}
              style={{ backgroundColor: 'green', padding: 1 }}
              renderItem={(items, i) => {
                console.log('resultRiwayat Absensi', items)
                return (
                  <View style={{ width: 100 }}>
                    <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{items.day.toUpperCase()}</Text>
                    <Text style={{ marginLeft: 10, marginTop: 35, fontSize: 15, color: '#000000' }}>01-02-2024</Text>
                  </View>
                )
              }} />
          </View> */}

          <LibList
            data={TeacherScheduleClass}
            renderItem={(items, i) => {
              console.log('riwayat absensi', items)
              return (
                <View style={{ marginBottom: 10, marginTop: 10, backgroundColor: '#0DBD5E', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 370, padding: 2 }}>
                <View style={{ flexDirection: 'row', width: 360, height: 100, backgroundColor: '#FFFFFF', borderRadius: 10, justifyContent: 'space-between' }}>
    
                  <View>
                    <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{items.day.toUpperCase()}</Text>
                    <Text style={{ marginLeft: 10, marginTop: 35, fontSize: 15, color: '#000000' }}>01-02-2024</Text>
                  </View>
    
                  <View style={{ height: 100, width: 100, justifyContent: 'center', alignItems: 'center' }}>
    
                    <Svg width={100} height={100} style={{ justifyContent: 'center', alignItems: 'center' }}>
    
                      <Circle
                        cx={100 / 2}
                        cy={100 / 2}
                        r={R}
                        fillOpacity={0.8}
                        stroke={'#96fdc6'}
                        strokeWidth={20}
                        fill={'none'}
                      />
    
                      <Circle
                        cx={100 / 2}
                        cy={100 / 2}
                        r={R}
                        // strokeOpacity={0.8}
                        stroke={'#0DBD5E'}
                        strokeWidth={12}
    
                        fill={'none'}
                        // fillOpacity={0.8}
                        strokeDasharray={`${Circle_length}`}
                        strokeDashoffset={Circle_length / 2}
                        strokeLinecap="round"
                      />
    
                    </Svg>
                    <Text style={{ position: 'absolute', color: '#000000' }}>4/8</Text>
                  </View>
                </View>
              </View>
              
              //  <View>
                //    <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 22, color: '#4B7AD6' }}>{i}</Text>
                //             <Text>{items?.day ??'sjdoijsdoi'}</Text>
                //             <LibList data={items.schedule}
                //                       renderItem={(item,i)=>{
                //                        console.log('student data:',item)

                //                        return(
                //                          <Text>{item.clock_end}</Text>
                //                        )
                //                       }}/>
                //  </View>

                // <View key={i}>
                //       <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{items.day}</Text>
                //       <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 15, color: '#000000' }}>01-02-2024</Text>

                //     <View style={{ height: 100, width: 100, justifyContent: 'center', alignItems: 'center' }}>

                //       <Svg width={100} height={100} style={{ justifyContent: 'center', alignItems: 'center' }}>

                //         <Circle
                //           cx={100 / 2}
                //           cy={100 / 2}
                //           r={R}
                //           fillOpacity={0.8}
                //           stroke={'#96fdc6'}
                //           strokeWidth={20}
                //           fill={'none'}
                //         />

                //         <Circle
                //           cx={100 / 2}
                //           cy={100 / 2}
                //           r={R}
                //           // strokeOpacity={0.8}
                //           stroke={'#0DBD5E'}
                //           strokeWidth={12}

                //           fill={'none'}
                //           // fillOpacity={0.8}
                //           strokeDasharray={${Circle_length}}
                //           strokeDashoffset={Circle_length / 2}
                //           strokeLinecap="round"
                //         />

                //       </Svg>
                //       <Text style={{ position: 'absolute', color: '#000000' }}>4/8</Text>
                //     </View>
                // </View>

              )
            }}
          />

         

          <View style={{ marginBottom: 10, marginTop: 10, backgroundColor: '#0DBD5E', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 370, padding: 2 }}>
            <View style={{ flexDirection: 'row', width: 360, height: 100, backgroundColor: '#FFFFFF', borderRadius: 10, justifyContent: 'space-between' }}>

              <View>
                <Text style={{ marginLeft: 10, marginTop: 5, fontSize: 22, color: '#000000' }}>{TeacherScheduleClass[0]?.day.toUpperCase()}</Text>
                <Text style={{ marginLeft: 10, marginTop: 35, fontSize: 15, color: '#000000' }}>01-02-2024</Text>
              </View>

              <View style={{ height: 100, width: 100, justifyContent: 'center', alignItems: 'center' }}>

                <Svg width={100} height={100} style={{ justifyContent: 'center', alignItems: 'center' }}>

                  <Circle
                    cx={100 / 2}
                    cy={100 / 2}
                    r={R}
                    fillOpacity={0.8}
                    stroke={'#96FDC6'}
                    strokeWidth={20}
                    fill={'none'}
                  />

                  <Circle
                    cx={100 / 2}
                    cy={100 / 2}
                    r={R}
                    fillOpacity={0.8}
                    stroke={'#0DBD5E'}
                    strokeWidth={12}

                    fill={'none'}
                    // fillOpacity={0.8}
                    strokeDasharray={`${Circle_length}`}
                    strokeDashoffset={Circle_length / 65}
                    strokeLinecap='round'
                  />
                </Svg>

                <Text style={{ position: 'absolute', color: '#000000' }}>8/8</Text>
              </View>
            </View>
          </View>

          {/* <FlatList
         horizontal={true}
         scrollEnabled={true}
         contentContainerStyle={{ width: '100%' }}
         /> */}

        </View>


      );
    } else {
      return (
        <View>
          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 5, marginHorizontal: 20 }}>Jadwal anak</Text>

          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20, marginHorizontal: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allDays.map(day => (
                <TouchableOpacity
                  key={day}
                  onPress={() => setSelectedDay(day)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedDay === day ? '#4B7AD6' : '#AAAAAA',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedDay === day ? '#FFFFFF' : '#FFFFFF' }}>{day}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>

          {/* <Text > d {JSON.stringify(TeacherScheduleClass)}</Text> */}

          <LibList
            data={TeacherScheduleClass}
            renderItem={(items, i) => {
              console.log(items)
              return (
                //  <View>
                //    <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 22, color: '#4B7AD6' }}>{i}</Text>
                //             <Text>{items?.day ??'sjdoijsdoi'}</Text>
                //             <LibList data={items.schedule}
                //                       renderItem={(item,i)=>{
                //                        console.log('student data:',item)

                //                        return(
                //                          <Text>{item.clock_end}</Text>
                //                        )
                //                       }}/>
                //  </View>
                <View key={i} style={{ marginBottom: 10, backgroundColor: '#4B7AD6', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 370, padding: 2, alignSelf: 'center' }}>
                  <View style={{ flex: 1, justifyContent: 'space-between', flexDirection: 'row', overflow: 'hidden', width: 360, height: 100, backgroundColor: '#FFFFFF', borderRadius: 10 }}>
                    <View style={{ flexDirection: 'row' }}>
                      <View style={{ justifyContent: 'center', alignItems: 'flex-start' }}>
                        <Text style={{ fontSize: 60, color: '#4B7AD6', marginLeft: -18 }}>00</Text>
                      </View>

                      <View style={{ height: 'auto', width: 2, backgroundColor: '#4B7AD6', opacity: 0.4 }} />

                      <View>
                        <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 22, color: '#4B7AD6' }}>{items.day.toUpperCase()}</Text>
                        <Text style={{ marginLeft: 10, marginBottom: 35, fontSize: 15, color: '#4B7AD6' }}>00:00 - 00:00</Text>
                      </View>

                    </View>

                    <MaterialIcons name='library-books' size={100} color='#B7CAEF' style={{ marginRight: -20, marginTop: 10 }} />

                  </View>
                </View>
              )
            }}
          />
        </View>
      );
    }
  }

  return (
    <View style={{ flex: 1 }}>
      <ScrollView showsVerticalScrollIndicator={false}>

        <View style={{ flex: 1, backgroundColor: '#4B7AD6', borderBottomRightRadius: 20, borderBottomLeftRadius: 20, padding: 20, paddingTop: 40 }}>

          <View style={{ backgroundColor: '#FFFFFF', height: 120, justifyContent: 'flex-start', alignItems: 'center', marginVertical: 20, padding: 15, flexDirection: 'row', borderRadius: 10 }}>
            <Image source={require('../../assets/anies.png')} style={{ width: 95, height: 95, justifyContent: 'center' }} />

            <View style={{ marginLeft: 15, justifyContent: 'center', alignItems: 'flex-start' }}>
              <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>{ParentStudent?.student_data?.[0]?.student_name}</Text>
              <Text style={{ fontSize: 18, color: '#000000', textAlign: 'center', fontWeight: '600' }}>+{ParentStudent.phone}</Text>
            </View>

          </View>

          <View style={{ flexDirection: 'row', marginVertical: 2, justifyContent: 'space-evenly' }}>
            <Pressable onPress={() => Linking.openURL('https://wa.me/+6281295822119')} style={{ flexDirection: 'row', alignItems: 'center', padding: 10, backgroundColor: '#0aa724', borderRadius: 12, height: 60 }}>
              <LibIcon.FontAwesome name="phone" size={30} color="white" style={{ marginLeft: 125 }} />
              <Text style={{ fontSize: 16, color: 'white', marginRight: 125 }}>Wa Guru</Text>
            </Pressable>

            {/* <Pressable onPress={() => LibDialog.info("Info", "Masuk Coy")} style={{ flexDirection: 'row', alignItems: 'center', padding: 20, backgroundColor: '#3F8DFD', borderRadius: 12, height: 70 }}>
              <LibIcon.FontAwesome name="user-circle" size={30} color="white" style={{ marginRight: 10 }} />
              <Text style={{ fontSize: 16, color: 'white' }}>Ijinkan Anak</Text>
            </Pressable> */}
          </View>
        </View>

        <View style={{ flexDirection: 'row', margin: 20, justifyContent: 'center' }}>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[0])} key={0} style={{ paddingVertical: 15, paddingHorizontal: 5, backgroundColor: selectTab === allTabs[0] ? '#4B7AD6' : '#FFFFFF', justifyContent: 'center', alignItems: 'center', marginLeft: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomLeftRadius: 10, borderTopLeftRadius: 10 }}>
            <Text style={{ color: selectTab === allTabs[0] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[0]}</Text>
          </TouchableOpacity>

          <TouchableOpacity onPress={() => setSelectTab(allTabs[1])} key={1} style={{ paddingVertical: 15, paddingHorizontal: 32, backgroundColor: selectTab === allTabs[1] ? '#4B7AD6' : '#FFFFFF', justifyContent: 'center', alignItems: 'center', marginRight: 15, ...shadowS(6), width: LibStyle.width * 0.5 - 25, borderBottomRightRadius: 10, borderTopRightRadius: 10 }}>
            <Text style={{ color: selectTab === allTabs[1] ? '#FFFFFF' : '#000000', fontSize: 15, fontWeight: 'bold' }}>{allTabs[1]}</Text>
          </TouchableOpacity>
        </View>


        <Tabs />

      </ScrollView>

      <LibSlidingup ref={slideup}>
        <View style={{ height: 410, backgroundColor: 'white', padding: 10, borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingHorizontal: 20 }}>

          <TouchableOpacity onPress={() => { slideup.current?.hide() }} style={{ alignItems: 'flex-end' }}>
            <Feather name='x' size={35} color={'#000000'} />
          </TouchableOpacity>

          <View>
            <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 10, alignSelf: 'center' }}>Filter Kehadiran</Text>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih Bulan</Text>
          </View>

          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allMonths.map(month => (
                <TouchableOpacity
                  key={month}
                  onPress={() => setSelectedMonth(month)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedMonth === month ? '#4B7AD6' : '#AAAAAA',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>

                  <Text style={{ color: selectedMonth === month ? '#FFFFFF' : '#FFFFFF' }}>{month}</Text>

                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>

          <View>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: '#000000', marginTop: 5 }}>Pilih Minggu</Text>
          </View>

          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10, marginBottom: 20 }}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allWeeks.map(week => (
                <TouchableOpacity
                  key={week}
                  onPress={() => setSelectedWeek(week)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedWeek === week ? '#4B7AD6' : '#AAAAAA',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedWeek === week ? '#FFFFFF' : '#FFFFFF' }}>{week}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>

          <TouchableOpacity onPress={() => { slideup.current?.hide() }} style={{ width: "100%", height: 50, backgroundColor: '#4B7AD6', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 35 }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center' }}>Terapkan</Text>
          </TouchableOpacity>

        </View>
      </LibSlidingup>
    </View>
  )
}
export default memo(m);


{/* <View key={index} style={{ marginBottom: 10, backgroundColor: '#4B7AD6', borderRadius: 10, alignItems: 'flex-end', ...elevation(4), width: 350, padding: 2 }}>
<View style={{width: 340, height: 100, backgroundColor: '#FFFFFF', ...elevation(4), borderRadius: 10 }}>
 
  
  
  <View style={{ marginTop: -15, justifyContent: 'center', alignItems: 'flex-start'  }}>
  <Text style={{ fontSize: 60, color:'#4B7AD6' }}>00</Text>
  </View>

  <View style={{}}>
  <Text style={{fontSize: 22, color: '#4B7AD6' }}>{event}</Text>
  <Text style={{ fontSize: 15, color: '#4B7AD6' }}>00:00 - 00:00</Text>
  </View>

  <View style={{ alignSelf: 'flex-end', marginTop: -90}}>
    <MaterialIcons name='library-books' size={100} color='#B7CAEF' />
  </View>

</View>
</View> */}